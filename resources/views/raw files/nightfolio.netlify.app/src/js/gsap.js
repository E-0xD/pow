"use strict";

function runGlobalGsap() {
  const homeClassList = select("section#home").classList;
  if (homeClassList.contains("home-1")) gsapHome1();
  else if (homeClassList.contains("home-2")) gsapHome2();
  else gsapHome3();

  // fill-text
  gsapFillText({ itemClass: ".fill-text" });
  gsapFillText({ itemClass: ".client-fill-text" });
  // zoom-out-image
  gsapZoomOutImage({ itemClass: ".zoom-out-image" });
  // arrow-down
  gsapArrowDown({ itemClass: ".arrow img" });
  gsapArrowDown({ itemClass: ".client-arrow img" });
  // separators
  selectAll(".separator").forEach((a) =>
    gsap.to(a, {
      ease: "power1.inOut",
      scaleX: 1,
      scrollTrigger: {
        trigger: a,
        scrub: 3,
        end: "bottom center",
      },
    })
  );
  // portfolio overflow
  const container = select(".portfolio-overview-container");
  gsap.to(".col-slide-down-md", {
    y: 192,
    ease: "none",
    scrollTrigger: {
      trigger: container,
      scrub: 1,
    },
  });
  gsap.to(".col-slide-down", {
    y: 32,
    ease: "none",
    scrollTrigger: {
      trigger: container,
      scrub: 1,
    },
  });
  // ------ global GSAP code ------ //
}

function gsapStackedCards({ containerClass, scale }) {
  // stacked-card
  selectAll(`${containerClass} .stacked-card`)
    .slice(0, -1)
    .forEach((card) => {
      gsap.to(card, {
        scale,
        ease: "power1.inOut",
        scrollTrigger: {
          trigger: card,
          start: "top 64px",
          scrub: 0.3,
        },
      });
    });
}

function gsapProjectSideCards() {
  // side-cards
  selectAll(".side-card").forEach((item, i) => {
    const isEven = i % 2 === 0;
    return gsap.fromTo(
      item,
      {
        rotate: isEven ? -30 : 30,
        x: isEven ? -150 : 150,
        y: 300,
        scale: 0.6,
      },
      {
        rotate: 0,
        x: 0,
        y: 0,
        scale: 1,
        ease: "power1.inOut",
        scrollTrigger: {
          trigger: item,
          scrub: 1.5,
          end: "top center",
        },
      }
    );
  });
  selectAll(".title").forEach((item) =>
    gsap.fromTo(
      item,
      {
        y: 100,
      },
      {
        y: 0,
        rotate: 0,
        ease: "power1.inOut",
        scrollTrigger: {
          trigger: item,
          scrub: 2,
          end: "top center",
        },
      }
    )
  );
  selectAll(".tools").forEach((item) =>
    gsap.fromTo(
      item,
      {
        y: 100,
        scale: 0.75,
        opacity: 0.5,
      },
      {
        scale: 1,
        y: 0,
        rotate: 0,
        opacity: 1,
        borderColor: "var(--text-primary)",
        ease: "power1.inOut",
        scrollTrigger: {
          trigger: item,
          scrub: 4,
          end: "top center",
        },
      }
    )
  );
}

function scrollStaggerAnimation({
  selector,
  containerSelector,
  start = "top 85%",
  fromVars = { opacity: 0, y: 100 },
  toVars = { opacity: 1, y: 0 },
  stagger = 0.1,
  duration = 0.8,
  ease = "power2.out",
}) {
  const elements = document.querySelectorAll(selector);
  const container = document.querySelector(containerSelector);
  if (!elements || !container) return;
  const tl = gsap.timeline({ paused: true });
  tl.fromTo(elements, fromVars, {
    ...toVars,
    duration,
    stagger,
    ease,
  });
  ScrollTrigger.create({
    trigger: container,
    start,
    onEnter: () => tl.play(),
    onLeaveBack: () => tl.reverse(),
  });
}

function gsapFillText({ itemClass }) {
  // fill text
  selectAll(itemClass).forEach((txt) => {
    gsap.to(txt, {
      ease: "power1.inOut",
      backgroundSize: "100% 100%",
      scrollTrigger: {
        trigger: txt,
        end: "bottom center",
        scrub: 1,
      },
    });
  });
}

function gsapZoomOutImage({ itemClass }) {
  // zoom out images
  selectAll(itemClass).forEach((img) => {
    gsap.to(img, {
      scale: 1,
      ease: "power1.inOut",
      scrollTrigger: {
        trigger: img,
        scrub: 1,
      },
    });
  });
}

function gsapArrowDown({ itemClass }) {
  selectAll(itemClass).forEach((a) =>
    gsap.to(a, {
      ease: "power1.inOut",
      rotate: 0,
      opacity: 1,
      scrollTrigger: {
        trigger: a,
        end: "bottom center",
        scrub: 1,
      },
    })
  );
}

function gsapHome1() {
  // ------ home-1 ------ //
  const heroText = select(".hero-text");
  const heroImage = select(".hero-image");
  gsap.to(heroText, {
    ease: "none",
    y: -100,
    scrollTrigger: {
      trigger: heroText,
      start: "top 128px",
      scrub: true,
    },
  });
  gsap.to(heroImage, {
    ease: "power1.inOut",
    scale: 1.25,
    scrollTrigger: {
      trigger: heroImage,
      start: "top 75%",
      scrub: 1,
    },
  });
  // ------ home-1 ------ //
}

function gsapHome2() {
  // ------ home-2 ------ //
  const sectionContainer = select(".section-container");
  gsap.to(sectionContainer, {
    ease: "none",
    y: 500,
    scrollTrigger: {
      trigger: sectionContainer,
      start: "top top",
      scrub: true,
    },
  });
  // ------ home-2 ------ //
}

function gsapHome3() {
  // ------ home-3 ------ //
  const shrinkText = select(".shrink-text");
  gsap.to(shrinkText, {
    ease: "power1.inOut",
    scaleY: 1,
    scrollTrigger: {
      trigger: shrinkText,
      start: "top 64px",
      end: "bottom top",
      scrub: 1,
    },
  });
  // ------ home-3 ------ //
}

function footerGsap() {
  const footer = select("footer");
  const footerPlaceholder = select(".footer-placeholder");
  gsap.fromTo(
    footer,
    { y: 500 },
    {
      y: 0,
      ease: "none",
      scrollTrigger: {
        trigger: footerPlaceholder,
        start: "top bottom",
        end: "top top",
        scrub: true,
      },
    }
  );
}
