let featuresList = [];
let indicatorsList = [];
let pos = { top: 0, left: 0, x: 0, y: 0 };

const features = document.querySelectorAll(".features-row > .card");
const featuresRow = document.querySelector(".features-row");
const indicatorRow = document.querySelector(".feature-indicator-row");

// Add an arrow left of dot navigation indicators
indicatorRow.innerHTML += `<div style="color:#D6004A"><i class="fa-solid fa-angles-left"></i></div>`;

// First setup selectors and the features list
features.forEach((element, index) => {
    // add attributes to current element
    element.id = "feature-card-" + index;
    element.classList.add("feature-" + index);

    // make feature indicator div and append to indicator row
    let indicatorClass = `feature-indicator indicator-${index} mx-2`;

    if (index === 0) {
        indicatorClass += " active";
    }

    if (index % 2 === 0)
        indicatorRow.innerHTML += `<div style="align-self:center" class="${indicatorClass}" data-target="${element.id}" data-index="${index}"></div>`;
});

// Add an arrow right of dot navigation indicators
indicatorRow.innerHTML += `<div style="color:#D6004A"><i class="fa-solid fa-angles-right"></i></div>`;

const mouseDownHandler = function (e) {
    pos = {
        left: featuresRow.scrollLeft,
        top: featuresRow.scrollTop,
        x: e.clientX,
        y: e.clientY,
    };

    featuresRow.style.cursor = "grab";
    featuresRow.classList.add("dragging");

    document.addEventListener("mousemove", mouseMoveHandler);
    document.addEventListener("mouseup", mouseUpHandler);
};
document.addEventListener("mousedown", mouseDownHandler);

let previousScrollLeft = 0;
let current = document.querySelector(".feature-indicator.active");
let currentIndex = parseInt(current.getAttribute("data-index"));
let lastIndex = document.querySelectorAll(".feature-indicator").length * 2;

const mouseMoveHandler = (e) => {
    // How far the mouse has been moved
    const dx = e.clientX - pos.x;
    const offset = current.offsetLeft * 2;
    // Scroll the element
    featuresRow.scrollLeft = pos.left - dx;

    if (dx < 0 && featuresRow.scrollLeft > previousScrollLeft + offset) {
        previousScrollLeft += offset;
        currentIndex += 2;
        if (currentIndex < lastIndex)
            removeActiveClass(".feature-indicator.active");
        let next = document.querySelector(`.indicator-${currentIndex}`);
        if (next !== null) next.classList.add("active");
    } else if (
        dx > 0 &&
        featuresRow.scrollLeft < previousScrollLeft + offset &&
        currentIndex > 0
    ) {
        previousScrollLeft -= offset;
        currentIndex -= 2;
        removeActiveClass(".feature-indicator.active");
        let next = document.querySelector(`.indicator-${currentIndex}`);
        if (next !== null) next.classList.add("active");
    } else if (dx > 0 && currentIndex === 0) {
        removeActiveClass(".feature-indicator.active");
        document.querySelector(`.indicator-0`).classList.add("active");
    }
};

const mouseUpHandler = function () {
    document.removeEventListener("mousemove", mouseMoveHandler);
    document.removeEventListener("mouseup", mouseUpHandler);

    featuresRow.style.cursor = "default";
    featuresRow.style.removeProperty("user-select");

    featuresRow.classList.remove("dragging");
};
document.querySelectorAll(".feature-indicator").forEach((item, index) => {
    featuresRow.scrollLeft = 0;
    // add eventListener to indicator
    item.addEventListener("click", (event) => {
        // remove the active state from feature indicator
        removeActiveClass(".feature-indicator.active");
        // Then add active class to event.target
        event.target.classList.add("active");

        // Get the card in feature section
        let dataTarget = event.target.getAttribute("data-target");
        let target = document.getElementById(dataTarget);

        // Get current target offsetLeft position
        let offsetLeftPos = target.offsetLeft;

        // Target (width + margin-left/right) / 2
        let offsetCorrection = target.offsetWidth;

        // This should be changed :/
        featuresRow.scrollLeft = offsetLeftPos + 180;
    });
});
