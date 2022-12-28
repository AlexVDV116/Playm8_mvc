const hamburger = document.querySelector(".navbar-toggler");
const menuItems = document.querySelectorAll(".nav-link");

/**
 * Add eventListener to hamburger
 *
 * @event clicks
 */
hamburger.addEventListener("click", mobileMenu);

/**
 * Add eventListener on each menu item
 *
 * @array menuItems
 * @event click
 */
Array.from(menuItems).forEach(addEventListenerOnActive);

/**
 * On trigger hamburger event
 * toggle hamburger active state
 *
 * @returns {void}
 */
function mobileMenu() {
    // Toggle active class on hamburger
    hamburger.classList.toggle("active");
}

/**
 * Add onActive event listeners to current
 * element in iterative selection
 *
 * @param item current event item
 */
function addEventListenerOnActive(item) {
    item.addEventListener("click", onActive);
}

/**
 *
 * @param className className of the class to remove
 */
function removeActiveClass(className) {
    let active = document.querySelector(className);
    if (active !== null) {
        active.classList.remove('active');
    }
}

/**
 * While we're listening to an event, loop through
 * each menu item and check for actives. If found,
 * active states need to be removed first.
 *
 * Then check if current selection is not a nav-btn
 * and add active state to the current event target
 *
 * @param event current event in listener
 */
function onActive(event) {

    removeActiveClass('.nav-link.active');

    // when even.target doesn't contain classname
    if (!event.target.classList.contains('nav-button'))
        // Then add active class to event.target
        event.target.classList.add("active");
}