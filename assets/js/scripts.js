const hamburger = document.querySelector(".navbar-toggler");
const menuItems = document.querySelectorAll(".nav-link");
const menuItemsMobile = document.querySelectorAll(".nav-btn");

// Add eventListener to hamburger
hamburger.addEventListener("click", mobileMenu);

// Add eventListener on each menu item
Array.from(menuItems).forEach(addEventListenerOnActive);

// On trigger hamburger event toggle hamburger active state
function mobileMenu() {
    // Toggle active class on hamburger
    hamburger.classList.toggle("active");

    // On menu collapse change styling of menu items in menuItemsMobile array by adding or removing .menu-items-mobile class
    if (hamburger.classList.contains("active")) {
        menuItemsMobile.forEach((item) => {
            item.classList.add("menu-items-mobile");
        });
    } else {
        menuItemsMobile.forEach((item) => {
            item.classList.remove("menu-items-mobile");
        });
    }
}

// Add onActive event listeners to current element in iterative selection
function addEventListenerOnActive(item) {
    item.addEventListener("click", onActive);
}

function removeActiveClass(className) {
    let active = document.querySelector(className);
    if (active !== null) {
        active.classList.remove("active");
    }
}

/**
 * While we're listening to an event, loop through
 * each menu item and check for actives. If found,
 * active states need to be removed first.
 *
 * Then check if current selection is not a nav-btn
 * and add active state to the current event target
 */
function onActive(event) {
    removeActiveClass(".nav-link.active");

    // when even.target doesn't contain classname
    if (!event.target.classList.contains("nav-button"))
        // Then add active class to event.target
        event.target.classList.add("active");
}
