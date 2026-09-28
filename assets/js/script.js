import initVue from "./vue/init";
import initMenu from "./main-menu";
//import initPageHeaderResize from "./page-header-resize";
import animationsV2 from "./animationsv2";
import featurePanel from "./feature-panel";
import initCookieAccept from "./cookie-accept";
import initSliders from "./sliders";
// import initHomeHeroVideo from "./home-hero-video";
import initAccordion from "./accordion";
import initFaqAccordions from "./faq-accordion";
import initToggleContent from "./toggle-content";
import initImageColumnPanel from "./image-column-panel";
import initBadgeLogoMorph from "./badge-logo-morph";
import initRouteMap from "./route-map";
import initPlanyoPlanSwitcher from "./planyo-plan-switcher";
import initSupportPanel from "./support-panel";
import initCustomSelects from "./custom-select";
import initHeroWave from "./hero-wave";
import initVideoFacade from "./video-facade";

function ready(fn) {
  if (document.readyState !== "loading") {
    fn();
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

ready(() => {
  initVue();
  initMenu();
  initCookieAccept();
  // Sliders first: they can duplicate slides for loop mode, and those
  // copies need to exist before animationsV2 starts observing .animate.
  initSliders();
  animationsV2();
  featurePanel();
  initAccordion();
  initFaqAccordions();
  initToggleContent();
  initImageColumnPanel();
  initBadgeLogoMorph();
  initRouteMap();
  initPlanyoPlanSwitcher();
  initSupportPanel();
  initCustomSelects();
  initHeroWave();
  initVideoFacade();
});
