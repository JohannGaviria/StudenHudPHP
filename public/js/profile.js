document.addEventListener("DOMContentLoaded", function () {
    const editableElements = document.querySelectorAll(".editable");
    const profilePic = document.getElementById("profile-pic");
    const imageUpload = document.getElementById("image-upload");

    editableElements.forEach(element => {
        element.addEventListener("click", function () {
            const currentValue = this.textContent;
            const inputElement = document.createElement("input");
            inputElement.value = currentValue;

            inputElement.addEventListener("blur", () => {
                const newValue = inputElement.value;
                this.textContent = newValue;
            });

            this.textContent = "";
            this.appendChild(inputElement);
            inputElement.focus();
        });
    });

    imageUpload.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

function addNewElement(ulSelector) {
    var ul = document.querySelector(ulSelector);

    var newElement = document.createElement("li");

    newElement.innerHTML = `
            <div class="date">
                <div class="icon-text">
                    <p class="editable">New date range</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
            </div>
            <div class="info">
                <div class="icon-text">
                    <p class="semi-bold editable">New title</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
                <div class="icon-text">
                    <p class="editable">New content</p>
                    <i class="fas fa-pencil-alt"></i>
                </div>
            `;

    ul.appendChild(newElement);

    var clonedElements = newElement.querySelectorAll(".editable");
    clonedElements.forEach(function (element) {
        element.classList.add("editable");

        element.addEventListener("click", function () {
            const currentValue = this.textContent;
            const inputElement = document.createElement("input");
            inputElement.value = currentValue;

            inputElement.addEventListener("blur", () => {
                const newValue = inputElement.value;
                this.textContent = newValue;
            });

            this.textContent = "";
            this.appendChild(inputElement);
            inputElement.focus();
        });
    });
}


function addNewSkill(ulSelector) {
    var ul = document.querySelector(ulSelector);

    var newElement = document.createElement("li");

    newElement.innerHTML = `
        <div class="skill-name">
            <div class="icon-text">
                <p class="editable">New Skill</p>
                <i class="fas fa-pencil-alt"></i>
            </div>
        </div>
        <div class="skill-progress">
            <span style="width: 0%;"></span>
        </div>
        <div class="skill-per">
            <div class="icon-text">
                <p class="editable">0%</p>
                <i class="fas fa-pencil-alt"></i>
            </div>
        </div>
    `;

    ul.appendChild(newElement);

    var clonedElements = newElement.querySelectorAll(".editable");
    clonedElements.forEach(function (element) {
        element.classList.add("editable");

        element.addEventListener("click", function () {
            const currentValue = this.textContent;
            const inputElement = document.createElement("input");
            inputElement.value = currentValue;

            inputElement.addEventListener("blur", () => {
                const newValue = inputElement.value;
                this.textContent = newValue;
            });

            this.textContent = "";
            this.appendChild(inputElement);
            inputElement.focus();
        });
    });
}

function displayPhoto(event) {
    const preview = document.getElementById('photo-preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        preview.setAttribute('src', e.target.result);
        preview.style.display = 'block';
    };

    reader.readAsDataURL(file);
}
function openFileExplorer() {
    document.getElementById('photo').click();
}