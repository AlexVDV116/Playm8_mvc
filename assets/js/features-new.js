// Create an array that contains all 'dot elements'
let dotCollection = Array.from(
    document.getElementsByClassName("dot-navigation__item")
);

// Get the current element with the .active-dot class (returns a HTML Collection)
let activeDot = document.getElementsByClassName("active-dot");

// Function that iterates over all elements in the dotCollection array and compares them to
// the first item in the activeDot HTML collection
// If there is a match, get the index number of that element and return it
function getActiveDotIndex() {
    let activeDotIndex = null;

    for (element of dotCollection) {
        if (element === activeDot[0]) {
            activeDotIndex = dotCollection.indexOf(element);
        }
    }
    return activeDotIndex;
}

// Function that removes the .active-dot class from the old element
// Adds the .active-dot class to the next or previous item of the dotCollection array
function changeDot(direction) {
    let activeDotIndex = getActiveDotIndex();

    if (direction === "right") {
        let newActiveDotIndex = activeDotIndex + 1;

        if (newActiveDotIndex <= 2) {
            // Remove old .active-dot element
            dotCollection[activeDotIndex].classList.remove("active-dot");

            // Add .active-dot to new element
            dotCollection[newActiveDotIndex].classList.add("active-dot");
        }
    }

    if (direction === "left") {
        let newActiveDotIndex = activeDotIndex - 1;

        if (newActiveDotIndex >= 0) {
            // Remove old .active-dot element
            dotCollection[activeDotIndex].classList.remove("active-dot");

            // Add .active-dot to new element
            dotCollection[newActiveDotIndex].classList.add("active-dot");
        }
    }

    // Add .active-dot class on dot that has been clicked on
    if (direction === "farLeft") {
        // Remove old .active-dot element
        dotCollection[activeDotIndex].classList.remove("active-dot");

        // Add .active-dot to new element
        dotCollection[0].classList.add("active-dot");
    } else if (direction === "middle") {
        // Remove old .active-dot element
        dotCollection[activeDotIndex].classList.remove("active-dot");

        // Add .active-dot to new element
        dotCollection[1].classList.add("active-dot");
    } else if (direction === "farRight") {
        // Remove old .active-dot element
        dotCollection[activeDotIndex].classList.remove("active-dot");

        // Add .active-dot to new element
        dotCollection[2].classList.add("active-dot");
    }
}

// Function that scrolls the feature cards to the left or right and calls the
// appropiate changeDot function when the arrow has been clicked
const outsider = document.getElementById("outsider");
const distance = 800;

function scrollLft() {
    outsider.scrollBy({
        left: -distance,
        behavior: "smooth",
    });
    changeDot("left");
}

function scrollRight() {
    outsider.scrollBy({
        left: distance,
        behavior: "smooth",
    });
    changeDot("right");
}

// Function that scrolls to the far left, middle, or far right
// when one of the individual dots have been clicked
function scrollFarLeft() {
    outsider.scrollBy({
        left: -1500,
        behavior: "smooth",
    });
    changeDot("farLeft");
}

function scrollMiddle() {
    outsider.scrollTo({
        left: 700,
        behavior: "smooth",
    });
    changeDot("middle");
}

function scrollFarRight() {
    outsider.scrollTo({
        left: 1500,
        behavior: "smooth",
    });
    changeDot("farRight");
}
