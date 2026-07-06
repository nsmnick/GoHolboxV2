// Scroll-scrubbed logo morph: the badge starts centred over the hero and
// travels to its resting spot in the menu bar as the user scrolls, tied
// 1:1 to scroll position (same technique as the hero-name → nav-logo
// morph on jacob-morley-website — a fixed "clone" element whose
// transform is recalculated every scroll frame from the live positions
// of a real hero reference point and the real nav target element).
function lerp(a, b, t) {
  return a + (b - a) * t;
}

function easeInOut(t) {
  return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
}

// Must match $mobile-menu-snap in assets/styles/setup/_global.scss.
const MOBILE_MENU_SNAP = 1250;

// Minimum breathing room between the badge's bottom edge and the top of
// the heading text.
const HEADING_GAP = 16;

// The hero photos are visually heavier on one side (more landmass/detail)
// than the other, so a mathematically-centred badge reads as off-centre —
// nudge its resting X position slightly to compensate. It's a rotating
// carousel of several photos with different compositions, so this can't be
// exactly right for every slide — it's a small universal compromise, not a
// per-photo calculation.
const OPTICAL_NUDGE_RATIO = -0.015;

export default function initBadgeLogoMorph() {
  const target = document.getElementById("badgeLogoTarget");
  const morph = document.getElementById("badgeLogoMorph");
  const morphImg = morph ? morph.querySelector(".site-badge-logo-morph__img") : null;
  const heroPanel = document.querySelector(".hero-panel");

  if (!target || !morph || !morphImg) return;

  // No hero on this page to morph from — just show the logo permanently
  // in its menu-bar spot, except on mobile where it should never sit there.
  if (!heroPanel) {
    morph.style.display = "none";

    const syncNonHeroLogo = () => {
      target.classList.toggle("is-visible", window.innerWidth >= MOBILE_MENU_SNAP);
    };

    syncNonHeroLogo();
    window.addEventListener("resize", syncNonHeroLogo, { passive: true });
    return;
  }

  const heading = heroPanel.querySelector(".hero-panel__heading");

  let heroTopDocY = 0;
  let heroHeight = 0;
  let heroImgSize = 0;
  let navSize = 0;
  let heroCenterDocY = 0;
  let heroCenterDocX = 0;

  function measure() {
    const heroRect = heroPanel.getBoundingClientRect();
    heroTopDocY = heroRect.top + window.scrollY;
    heroHeight = heroPanel.offsetHeight;

    // Read the hero's own rendered centre rather than window.innerWidth —
    // innerWidth includes the scrollbar's width on non-overlay scrollbars,
    // which would centre the badge slightly right of the actual visible
    // content.
    heroCenterDocX = heroRect.left + heroRect.width / 2 + heroRect.width * OPTICAL_NUDGE_RATIO;

    // Read sizes via computed style, not getBoundingClientRect — the morph
    // clone has a live transform applied to it, which would otherwise
    // contaminate the "natural" size we scale from.
    heroImgSize = parseFloat(getComputedStyle(morphImg).width);
    navSize = parseFloat(getComputedStyle(target).width);

    // Prefer dead-centre in the hero, but the heading wraps to a different
    // number of lines at different widths (and its font-size is fluid), so
    // how much room that leaves can't be predicted from viewport width
    // alone — measure the heading's live position instead of guessing.
    const idealCenterDocY = heroTopDocY + heroHeight * 0.5;
    if (heading) {
      const headingTopDocY = heading.getBoundingClientRect().top + window.scrollY;
      const maxCenterDocY = headingTopDocY - heroImgSize / 2 - HEADING_GAP;
      heroCenterDocY = Math.min(idealCenterDocY, maxCenterDocY);
    } else {
      heroCenterDocY = idealCenterDocY;
    }
  }

  function update() {
    const scrollY = window.scrollY;
    const rawP = Math.max(0, Math.min(1, scrollY / (heroHeight * 0.6)));
    const p = easeInOut(rawP);

    // Live target position (re-read every frame — it can itself move,
    // e.g. when the header slides away on scroll-down).
    const targetRect = target.getBoundingClientRect();
    const targetCenterX = targetRect.left + targetRect.width / 2;
    const targetCenterY = targetRect.top + targetRect.height / 2;

    // Live hero starting-point position — heroCenterDocY is a fixed document
    // coordinate (computed in measure()), so subtracting scrollY reproduces
    // exactly how a normally-flowing element would move as the page scrolls.
    const heroCenterX = heroCenterDocX;
    const heroCenterY = heroCenterDocY - scrollY;

    const scaleEnd = navSize / heroImgSize;
    const currentScale = lerp(1, scaleEnd, p);

    // The badge only ever travels from hero-centre toward the (always
    // further-left) nav target — clamp defensively so it can never render
    // to the right of its hero-centred starting point, even if a stray
    // mid-scroll re-measure (resize, momentum/rubber-band scrolling, etc.)
    // ever put the two ends of the interpolation out of order.
    const currentCenterX = Math.min(lerp(heroCenterX, targetCenterX, p), heroCenterX);
    const currentCenterY = lerp(heroCenterY, targetCenterY, p);

    // transform-origin is top-left, so convert the desired centre point
    // back to a top-left offset at the current (interpolated) scale.
    const half = (heroImgSize * currentScale) / 2;
    const topLeftX = currentCenterX - half;
    const topLeftY = currentCenterY - half;

    morph.style.transform = `translate(${topLeftX}px, ${topLeftY}px) scale(${currentScale})`;

    const landed = p >= 0.999;

    if (window.innerWidth < MOBILE_MENU_SNAP) {
      // Mobile menu bar: no logo should be left sitting in it — let the
      // animation carry it the rest of the way there, then fade it out
      // over the final part of the journey instead of landing solid.
      const fadeStart = 0.75;
      const fadeAmount = Math.max(0, (p - fadeStart) / (1 - fadeStart));
      morph.style.opacity = String(1 - fadeAmount);
      morph.style.pointerEvents = fadeAmount >= 1 ? "none" : "auto";
      target.classList.remove("is-visible");
    } else {
      // Desktop: hand off to the real (accessible) target link once landed.
      morph.style.opacity = landed ? "0" : "1";
      morph.style.pointerEvents = landed ? "none" : "auto";
      target.classList.toggle("is-visible", landed);
    }
  }

  measure();
  update();

  // The heading's position depends on the custom font's metrics — if it's
  // still loading when we first measured, re-measure once it's ready so the
  // badge doesn't end up clamped against a pre-web-font layout.
  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(() => {
      measure();
      update();
    });
  }

  window.addEventListener("scroll", update, { passive: true });

  // Recompute on every animation frame while the window is actively being
  // resized, not after a debounce delay — otherwise the logo stays frozen
  // at its old position/scale for the whole drag and then snaps into place
  // once you stop, instead of tracking the resize live.
  let resizeTicking = false;
  window.addEventListener(
    "resize",
    () => {
      if (resizeTicking) return;
      resizeTicking = true;
      requestAnimationFrame(() => {
        measure();
        update();
        resizeTicking = false;
      });
    },
    { passive: true },
  );
}
