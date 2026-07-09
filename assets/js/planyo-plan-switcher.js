// Planyo doesn't support one form with a built-in vehicle/plan picker —
// each plan in planyo-booking-panel.php is a fully separate widget (own
// form, own resource_id, own scripts). This fakes a single picker by
// keeping only one plan "live" in the DOM at a time: the PHP template
// wraps each plan in an inert <template>, and clicking a tab here clones
// the chosen one into .planyo-booking-panel__active-widget.
//
// This has to be swap-not-show/hide. Several of Planyo's own field ids
// (start_time, rental_prop_From, rental_prop_To, rental_prop_persons,
// res_form_buttons, planyo_price_preview_widget) are NOT unique per plan
// — only the date field, form, and price-preview containers carry a
// per-plan numeric suffix. Rendering more than one plan live at once
// would create duplicate ids, breaking the getElementById-based lookups
// Planyo's own scripts rely on.
//
// <script> tags cloned out of a <template> are a subtler trap than "they
// just don't run": cloneNode() doesn't copy the "already started" flag
// that innerHTML-inserted scripts get, so a cloned script DOES execute
// the instant it's connected to the document via appendChild — but with
// no control over order, and none of the src ones awaited, so the inline
// scripts that call functions defined by the utils.js/wrappers.js <script
// src> tags immediately before them throw ReferenceErrors (those loads
// hadn't finished yet). Tested and confirmed: leaving the clone's scripts
// in place and separately re-running them via createElement, expecting
// the untouched originals to stay inert, actually ran every script
// twice — once uncontrolled on appendChild, once correctly afterward.
// So scripts are stripped out of the fragment before it ever touches the
// live DOM, and run separately, one at a time, awaiting each external
// script's load event before starting the next.
//
// Switching plans re-runs those shared library scripts again each time —
// some redundant work, and Planyo's own document-level click/mousedown
// listeners (e.g. its calendar-close handler) accumulate rather than
// being cleaned up between switches. Accepted trade-off: we don't have
// visibility into Planyo's internals to safely dedupe that, and the
// listeners appear idempotent (closing an already-closed calendar is a
// no-op), so the cost is a little wasted work, not a visible bug.

import initPlanyoPricePreview from "./planyo-price-preview";

// oldScript is detached (pulled out of the cloned fragment before it was
// ever connected to the document, see activatePlan) — so this appends
// the recreated element directly to target rather than using
// replaceWith(), which needs a parent to replace within.
function runScript(oldScript, target) {
  return new Promise((resolve) => {
    const newScript = document.createElement("script");
    Array.from(oldScript.attributes).forEach((attr) =>
      newScript.setAttribute(attr.name, attr.value),
    );
    newScript.textContent = oldScript.textContent;

    if (newScript.src) {
      // Don't let one failed request (offline, blocked, etc.) hang every
      // later script forever — move on and let those fail on their own
      // missing dependency rather than silently freezing the whole form.
      newScript.addEventListener("load", resolve);
      newScript.addEventListener("error", resolve);
      target.appendChild(newScript);
    } else {
      // Inline scripts run synchronously the moment they're inserted, so
      // by the time appendChild() returns this one's already executed.
      target.appendChild(newScript);
      resolve();
    }
  });
}

async function runScriptsInOrder(scripts, target) {
  for (const script of scripts) {
    await runScript(script, target);
  }
}

async function activatePlan(widget, plan) {
  const template = widget.querySelector(`template[data-plan="${plan}"]`);
  const target = widget.querySelector(".planyo-booking-panel__active-widget");
  if (!template || !target) return;

  const fragment = template.content.cloneNode(true);
  const scripts = Array.from(fragment.querySelectorAll("script"));
  scripts.forEach((script) => script.remove());

  target.innerHTML = "";
  target.appendChild(fragment);

  // Elements exist immediately (Planyo populates them async on its own
  // later, via user interaction), so this doesn't need to wait on the
  // scripts below to finish loading first.
  initPlanyoPricePreview(widget);

  await runScriptsInOrder(scripts, target);
}

export default function initPlanyoPlanSwitcher() {
  document.querySelectorAll(".planyo-booking-panel__widget").forEach((widget) => {
    const tabs = Array.from(widget.querySelectorAll(".planyo-booking-panel__plan-tab"));
    if (!tabs.length) return;

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        if (tab.classList.contains("is-active")) return;

        tabs.forEach((t) => {
          t.classList.remove("is-active");
          t.setAttribute("aria-selected", "false");
        });
        tab.classList.add("is-active");
        tab.setAttribute("aria-selected", "true");

        activatePlan(widget, tab.dataset.plan);
      });
    });

    const initialTab = tabs.find((t) => t.classList.contains("is-active")) || tabs[0];
    activatePlan(widget, initialTab.dataset.plan);
  });
}
