function showForm() {
    var contactForm = document.getElementById("contact-form");
    var emailFiel = document.getElementById("email-field");
    var phoneFiel = document.getElementById("phone-field");
    var linkedinField = document.getElementById("linkedin-field");

    emailFiel.style.display = "none";
    phoneFiel.style.display = "none";
    linkedinField.style.display = "none";

    var select = contactForm.options[contactForm.selectedIndex].value;

    if (select === "email" || select === "all") {
        emailFiel.style.display = "block";
    }

    if (select === "phone" || select === "all") {
        phoneFiel.style.display = "block";
    }

    if (select === "linkedin" || select === "all") {
        linkedinField.style.display = "block";
    }
}