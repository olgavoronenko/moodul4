const menuButton = document.querySelector(".nav__toggle");
const mobileMenu = document.querySelector("#mobile-menu");
const currentPage = window.location.pathname.split("/").pop() || "index.html";

if (currentPage === "index.html") {
  document.querySelectorAll('a[href="index.html"]').forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();

      window.scrollTo({
        top: 0,
        behavior: window.matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth",
      });
    });
  });
}

if (menuButton && mobileMenu) {
  menuButton.addEventListener("click", () => {
    const isOpen = menuButton.getAttribute("aria-expanded") === "true";
    menuButton.setAttribute("aria-expanded", String(!isOpen));
    mobileMenu.hidden = isOpen;
  });

  mobileMenu.addEventListener("click", (event) => {
    if (event.target instanceof HTMLAnchorElement) {
      menuButton.setAttribute("aria-expanded", "false");
      mobileMenu.hidden = true;
    }
  });
}

const contactForm = document.querySelector("[data-contact-form]");
const formMessage = document.querySelector("[data-form-message]");

if (contactForm && formMessage) {
  contactForm.addEventListener("submit", (event) => {
    event.preventDefault();
    formMessage.textContent = "Aitäh! Sinu sõnum on saadetud.";
    contactForm.reset();
  });
}

const bookingTabs = document.querySelectorAll("[data-booking-tab]");
const bookingPanels = document.querySelectorAll("[data-booking-panel]");

if (bookingTabs.length && bookingPanels.length) {
  const activateBookingTab = (selected) => {
    bookingTabs.forEach((item) => {
      const isActive = item.getAttribute("data-booking-tab") === selected;
      item.classList.toggle("is-active", isActive);
      item.setAttribute("aria-selected", String(isActive));
    });

    bookingPanels.forEach((panel) => {
      const isActive = panel.getAttribute("data-booking-panel") === selected;
      panel.classList.toggle("is-active", isActive);
      panel.hidden = !isActive;
    });
  };

  bookingTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const selected = tab.getAttribute("data-booking-tab");
      activateBookingTab(selected);
    });
  });

  if (window.location.hash === "#adoption-form") {
    activateBookingTab("adoption");
  }
}

const counters = document.querySelectorAll("[data-counter]");

counters.forEach((counter) => {
  const minus = counter.querySelector("[data-counter-minus]");
  const plus = counter.querySelector("[data-counter-plus]");
  const value = counter.querySelector("[data-counter-value]");
  const input = counter.querySelector("[data-counter-input]");

  const setValue = (nextValue) => {
    const safeValue = Math.max(0, Math.min(12, nextValue));
    value.textContent = String(safeValue);
    input.value = String(safeValue);
  };

  minus.addEventListener("click", () => setValue(Number(input.value) - 1));
  plus.addEventListener("click", () => setValue(Number(input.value) + 1));
});

const bookingForms = document.querySelectorAll("[data-booking-form]");

bookingForms.forEach((form) => {
  const message = form.querySelector("[data-booking-message]");

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    message.textContent = "Aitäh! Saatsime sinu soovi edukalt teele.";
    form.reset();

    const counter = form.querySelector("[data-counter]");
    if (counter) {
      counter.querySelector("[data-counter-value]").textContent = "0";
      counter.querySelector("[data-counter-input]").value = "0";
    }
  });
});

const profileMainImage = document.querySelector("[data-profile-main-image]");
const profileThumbs = document.querySelectorAll("[data-profile-thumb]");

if (profileMainImage && profileThumbs.length) {
  profileThumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      const nextSrc = thumb.getAttribute("data-profile-thumb");
      const nextAlt = thumb.getAttribute("data-profile-alt");

      if (profileMainImage.getAttribute("src") === nextSrc) {
        return;
      }

      profileMainImage.classList.add("is-changing");

      window.setTimeout(() => {
        profileMainImage.src = nextSrc;
        profileMainImage.alt = nextAlt;
        profileMainImage.classList.remove("is-changing");
      }, 160);

      profileThumbs.forEach((item) => {
        item.classList.toggle("is-active", item === thumb);
      });
    });
  });
}

const catFilterInputs = document.querySelectorAll(".cat-filters input[type='radio']");
const catCards = document.querySelectorAll(".cat-card");

if (catFilterInputs.length && catCards.length) {
  let lastChecked = null;

  catFilterInputs.forEach((input) => {
    input.addEventListener("click", () => {
      if (lastChecked === input) {
        input.checked = false;
        lastChecked = null;
      } else {
        lastChecked = input;
      }

      const filters = {
        age: document.querySelector(".cat-filters input[name='age']:checked")?.value,
        gender: document.querySelector(".cat-filters input[name='gender']:checked")?.value,
        personality: document.querySelector(".cat-filters input[name='personality']:checked")?.value,
      };

      catCards.forEach((card) => {
        const matches = Object.entries(filters).every(([key, value]) => {
          return !value || card.dataset[key] === value;
        });

        card.classList.toggle("is-hidden", !matches);
      });
    });
  });
}
