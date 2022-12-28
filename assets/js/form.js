const forms = document.querySelectorAll(".needs-validation");
// Add eventListener on each form
Array.from(forms).forEach(addEventListenerOnFormSubmit);

function addEventListenerOnFormSubmit(form) {
    form.addEventListener("submit", onFormSubmit);
}

/**
 * While we're listening to the onsubmit event
 * of this form. Iterate through the items
 * of this current event and handle the
 * submission values of the form
 */
function onFormSubmit(event) {
    event.preventDefault();

    // make array out of form elements
    let formElements = Array.from(this.elements);

    // Extract values from the form
    formElements.forEach((element) => {
        // has value
        if (element.value)
            // Log these values (send to server in a later stage)
            console.log(element.value);
    });

    // Give user feedback on form submission
    this.classList.add("was-validated");

    // When the form is valid
    if (this.checkValidity()) {
        let name;
        let subject;

        formElements.forEach((element) => {
            if (element.id === "naam") {
                name = element.value;
                console.log(element.id);
                notify("success", `Bedankt voor je registratie, ${name}`);
            }

            if (element.id === "form_name") {
                name = element.value;
                subject = document.getElementById("form_need").value;
                console.log(element.id);
                notify(
                    "success",
                    `Bedankt voor uw contactopname, ${name}, uw ${subject} is in behandeling genomen.`
                );
            }
        });
    }
}
