// Planyo's price-preview widget injects one long block of plain text once
// a price is calculated — total, deposit, currency conversion, and several
// paragraphs of booking/payment small print all run together. We can't
// change what Planyo sends, so this watches for that text landing in the
// DOM, pulls out just the total and deposit with a couple of regexes, and
// rebuilds a clean summary up top. The original text is never discarded —
// it's moved into a <details> disclosure below the summary, so the small
// print (payment link timing, contact info, etc.) is still one click away.
//
// If the regexes don't match — different resource config, an
// availability/error message instead of a price, wording Planyo changes
// on their end — nothing is touched and the original text displays as-is.
// A wrong guess here should never hide information the visitor needs.
//
// The "Book Now" button next to the price is our own, not Planyo's —
// Planyo does separately drop its own reservation button into
// #res_form_buttons once a price is available, but relying on it showing
// up reliably next to the price wasn't good enough, so this one is always
// there the moment a price is. It submits the plan's actual <form> (GET,
// to the real booking URL), carrying forward every field the visitor
// already filled in — same destination Planyo's own button would send
// them to, just guaranteed to be there.

const TOTAL_PRICE_RE =
  /TOTAL PRICE FOR YOUR GROUP:\s*([\d,]+(?:\.\d+)?)\s*([A-Z]{3})\s*\/\s*([\d,]+(?:\.\d+)?)\s*([A-Z]{3})/i;
const DEPOSIT_RE = /Deposit:\s*([A-Z]{3})\s*([\d,]+(?:\.\d+)?)/i;

function formatAmount(raw) {
  const n = Number(String(raw).replace(/,/g, ""));
  return Number.isFinite(n) ? n.toLocaleString() : raw;
}

function buildCleanSummary(text) {
  const totalMatch = text.match(TOTAL_PRICE_RE);
  if (!totalMatch) return null;

  const [, amount1, currency1, amount2, currency2] = totalMatch;
  const depositMatch = text.match(DEPOSIT_RE);

  const wrap = document.createElement("div");
  wrap.className = "planyo-price-clean";
  wrap.innerHTML = `
    <p class="planyo-price-clean__label">Total price for your group</p>
    <p class="planyo-price-clean__amount">
      ${formatAmount(amount1)} <span>${currency1}</span>
      <span class="planyo-price-clean__divider">/</span>
      ${formatAmount(amount2)} <span>${currency2}</span>
    </p>
    ${
      depositMatch
        ? `<p class="planyo-price-clean__deposit">Deposit due now: ${formatAmount(depositMatch[2])} ${depositMatch[1]}</p>`
        : ""
    }
    <div class="planyo-price-clean__actions">
      <button type="button" class="planyo-price-clean__book-btn">Book Now</button>
    </div>
  `;

  return wrap;
}

// A price only shows once the visitor's filled in enough fields for
// Planyo to calculate one, so the form's already in a submittable state
// by the time this button exists — no extra validation needed here.
function submitBookingForm(widget) {
  const form = widget.querySelector('form[id^="planyo_price_preview_form"]');
  if (!form) return;

  if (typeof form.requestSubmit === "function") {
    form.requestSubmit();
  } else {
    form.submit();
  }
}

function enhance(container) {
  if (container.querySelector(".planyo-price-clean")) return;

  const text = container.textContent.trim();
  if (!text) return;

  const summary = buildCleanSummary(text);
  if (!summary) return;

  const original = document.createElement("div");
  original.innerHTML = container.innerHTML;

  const details = document.createElement("details");
  details.className = "planyo-price-clean__details";
  details.innerHTML = "<summary>View full booking details</summary>";
  details.appendChild(original);

  container.innerHTML = "";
  container.appendChild(summary);
  container.appendChild(details);

  const widget = container.closest(".planyo-booking-panel__widget") || document;
  const bookBtn = summary.querySelector(".planyo-price-clean__book-btn");
  if (bookBtn) {
    bookBtn.addEventListener("click", () => submitBookingForm(widget));
  }
}

function getWidgets(root) {
  if (root instanceof Element && root.matches(".planyo-booking-panel__widget")) {
    return [root];
  }
  return Array.from(root.querySelectorAll(".planyo-booking-panel__widget"));
}

// root defaults to the whole page (initial load), but planyo-plan-switcher.js
// also calls this scoped to a single widget after every plan swap — the
// price-preview containers are destroyed and recreated fresh each time a
// plan is activated, so the observers set up here need re-attaching to
// the new elements rather than surviving from a previous plan's DOM.
export default function initPlanyoPricePreview(root = document) {
  const widgets = getWidgets(root);

  widgets.forEach((widget) => {
    const priceContainers = Array.from(
      widget.querySelectorAll('[id^="planyo_price_preview"]'),
    ).filter((el) => /^planyo_price_preview[a-zA-Z]*\d+$/.test(el.id));

    priceContainers.forEach((container) => {
      const observer = new MutationObserver(() => enhance(container));
      observer.observe(container, {
        childList: true,
        subtree: true,
        characterData: true,
      });

      // In case a price is already present on load (e.g. browser
      // back/forward restoring form state).
      enhance(container);
    });
  });
}
