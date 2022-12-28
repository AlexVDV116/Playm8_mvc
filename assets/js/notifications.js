/**
 * Set message to the notification and call for the
 * animations
 */
function notify(type, msg) {
    // Instantiate the DOM element
    const element = createAlertElement(type);

    // Set message to element innerHTML
    element.innerHTML = msg;

    // Set up the animations
    slideIn(element);
    slideOut(element);

    // Return notification element back in case we want to do something with it
    return element;
}

/**
 * Create an alert element.
 *
 * The type defaults to success, so if you wish to create a new type
 * then fill in the type in the parameter when instantiating this object
 */
function createAlertElement(type = "success") {
    // Instantiate the notification object
    const notification = Object.assign(document.createElement("div"), {
        classList: `playm8-notification notify-${type}`,
    });

    // Add the object to the document body element
    document.body.append(notification);

    // Return the notification for easier access to the DOM element after creation
    return notification;
}

/**
 * Initiate slide in animation by adding the corresponding
 * class to the classList of the specified element
 */
function slideIn(element) {
    element.classList.add("animate-in");
}

/**
 * Initiate slide out animation by adding the corresponding
 * class to the classList of the specified element
 */
function slideOut(element, delayInMs = 5000) {
    setTimeout(() => {
        element.classList.remove("animate-in");
        element.classList.add("animate-out");
    }, delayInMs);

    // after timeout remove element
    removeElement(delayInMs + 1000);
}

function removeElement(delayInMs) {
    setTimeout(() => {
        document.querySelector(".playm8-notification").remove();
    }, delayInMs);
}
