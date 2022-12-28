// simple function to use for callback in the intersection observer
const changeNav = (entries, observer) => {
    entries.forEach((entry) => {
        // verify the element is intersecting
        if (entry.isIntersecting && entry.intersectionRatio >= 0.55) {
            // remove old active class
            var activeEle = document.querySelector(".nav-link.active");
            if (activeEle !== null) {
                activeEle.classList.remove("active");
            }

            // get id of the intersecting section
            var id = entry.target.id;

            // find matching link
            var newLink = document.querySelector(`[data-action="${id}"]`);

            //  if they match add the active class, else set about-section active
            if (newLink !== null) {
                newLink.classList.add("active");
            } else if (id == "hero-section") {
                document
                    .querySelector(`[data-action="about-section"]`)
                    .classList.add("active");
            }

            // keep active state on tester section once at the footer
            if (id == "tester-section" || id == "footer-section") {
                document
                    .querySelector(`[data-action="tester-section"]`)
                    .classList.add("active");
            }
        }
    });
};

// init the observer
const options = {
    threshold: 0.55,
};

const observer = new IntersectionObserver(changeNav, options);

// target the elements to be observed
const sections = document.querySelectorAll("section");
sections.forEach((section) => {
    observer.observe(section);
});
