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
