/* eslint-disable no-unused-vars */
import Swiper from "swiper";
import {
  Navigation,
  Pagination,
  EffectFade,
  Autoplay,
  Thumbs,
  A11y,
} from "swiper/modules";
import "swiper/css";
import "swiper/css/effect-fade";

// Swiper's loop mode needs noticeably more slides than are visible at once
// (roughly 2× the largest slidesPerView). With fewer — e.g. 3 cards on a
// 3-per-view desktop layout — it silently disables loop, leaving nothing to
// scroll and the arrows doing nothing. Duplicate the existing slides until
// there are enough, as Swiper's own warning recommends.
function ensureLoopSlides(swiperEl, slideSelector, minSlides) {
  const wrapper = swiperEl.querySelector(slideSelector)?.parentElement;
  if (!wrapper) return;

  const originals = Array.from(wrapper.querySelectorAll(`:scope > ${slideSelector}`));
  if (originals.length < 2) return;

  while (wrapper.querySelectorAll(`:scope > ${slideSelector}`).length < minSlides) {
    originals.forEach((slide) => wrapper.appendChild(slide.cloneNode(true)));
  }
}

export default function initSliders() {
  // Destination Slider + Activities Slider (the Activities Slider renders
  // through the same template — see activities-slider.php). Looped per
  // instance with scoped arrows, since both can sit on one page and a single
  // global selector would only start the first one / wire every arrow to it.
  document.querySelectorAll(".airport-swiper").forEach((swiperEl) => {
    const root = swiperEl.closest(".airport-slider__track");
    if (!root) return;

    ensureLoopSlides(swiperEl, ".swiper-slide", 6);

    new Swiper(swiperEl, {
      modules: [Navigation],
      slidesPerView: 1,
      centeredSlides: false,
      spaceBetween: 20,
      loop: true,
      navigation: {
        nextEl: root.querySelector(".airport-slider__btn--next"),
        prevEl: root.querySelector(".airport-slider__btn--prev"),
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
          centeredSlides: true,
          spaceBetween: 24,
        },
        960: {
          slidesPerView: 3,
          centeredSlides: true,
          spaceBetween: 30,
        },
      },
    });
  });

  // Image Slider Panel — same Navigation/breakpoints config as the Airport
  // Slider Panel above, looped per-instance so multiple Image Slider Panels
  // on one page each get their own independently-scoped arrows instead of
  // all sharing the first one's.
  document.querySelectorAll(".image-slider-panel-swiper").forEach((swiperEl) => {
    const root = swiperEl.closest(".image-slider-panel__track");
    if (!root) return;

    ensureLoopSlides(swiperEl, ".image-slider-panel__slide", 6);

    new Swiper(swiperEl, {
      modules: [Navigation],
      slidesPerView: 1,
      centeredSlides: false,
      spaceBetween: 20,
      loop: true,
      wrapperClass: "image-slider-panel__wrapper",
      slideClass: "image-slider-panel__slide",
      navigation: {
        nextEl: root.querySelector(".image-slider-panel__btn--next"),
        prevEl: root.querySelector(".image-slider-panel__btn--prev"),
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
          centeredSlides: true,
          spaceBetween: 24,
        },
        960: {
          slidesPerView: 3,
          centeredSlides: true,
          spaceBetween: 30,
        },
      },
    });
  });

  // Text and Image Panel's image slider — one Swiper per panel instance,
  // scoped to that instance's own arrows, dots and "1 / 3" counter (the
  // markup has all three). Previously a single global selector started only
  // the first panel on the page, with navigation switched off, so the
  // arrows did nothing and the counter never changed.
  document
    .querySelectorAll(".text-and-image-slider__slides-wrapper")
    .forEach((wrapperEl) => {
      const root = wrapperEl.closest(".text-and-image-panel__image");
      if (!root) return;

      const counterCurrent = root.querySelector(
        ".text-and-image-slider__counter-current",
      );

      new Swiper(wrapperEl, {
        modules: [Navigation, Autoplay, Pagination, A11y],
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,
        wrapperClass: "text-and-image-slider__slides",
        slideClass: "text-and-image-slider__slide",

        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: root.querySelector(".text-and-image-slider__arrow--next"),
          prevEl: root.querySelector(".text-and-image-slider__arrow--prev"),
        },
        pagination: {
          el: root.querySelector(".text-and-image-slider__pagination"),
          clickable: true,
          type: "bullets",
          bulletActiveClass: "text-and-image-slider__pagination__bullet--active",
          bulletClass: "text-and-image-slider__pagination__bullet",
          bulletElement: "div",
        },
        // A11y module gives the pagination container a valid role (replacing
        // the plain <div aria-label="Choose an image">, which PageSpeed
        // flags as an invalid ARIA host) and labels each bullet "Go to slide N".
        a11y: {
          paginationBulletMessage: "Go to slide {{index}}",
        },
        on: {
          slideChange(swiper) {
            if (counterCurrent) {
              counterCurrent.textContent = swiper.realIndex + 1;
            }
          },
        },
      });
    });

  // Service Cards Panel — one independent slider per card, so (unlike the
  // single-selector Swiper calls above) this instantiates one per matching
  // element rather than only binding the first. Cards with a single image
  // skip the nav/pagination markup entirely (see the block's PHP), so there
  // are no elements for Swiper to bind navigation/pagination to — loop is
  // also disabled in that case since Swiper's loop mode needs more than one
  // slide.
  document.querySelectorAll(".service-card-swiper").forEach((sliderEl) => {
    const slideCount = sliderEl.querySelectorAll(".swiper-slide").length;

    if (slideCount <= 1) {
      return;
    }

    new Swiper(sliderEl, {
      modules: [Navigation, Pagination, A11y],
      slidesPerView: 1,
      loop: true,
      navigation: {
        nextEl: sliderEl.querySelector(".service-card-swiper__btn--next"),
        prevEl: sliderEl.querySelector(".service-card-swiper__btn--prev"),
      },
      pagination: {
        el: sliderEl.querySelector(".service-card-swiper__pagination"),
        clickable: true,
        type: "bullets",
        bulletActiveClass: "service-card-swiper__bullet--active",
        bulletClass: "service-card-swiper__bullet",
        bulletElement: "span",
      },
      a11y: {
        paginationBulletMessage: "Go to slide {{index}}",
      },
    });
  });

  const heroSlider = new Swiper(".hero-slider__slides-wrapper", {
    modules: [EffectFade, Autoplay],
    slidesPerView: 1,
    loop: true,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    speed: 1500,
  });
}
