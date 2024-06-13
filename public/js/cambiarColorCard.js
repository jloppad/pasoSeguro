document.addEventListener('DOMContentLoaded', main);

function main() {
    const checkboxes = document.querySelectorAll(".card input[type='checkbox']");

    checkboxes.forEach(function(checkbox) {
        cambiarClase(checkbox);
        checkbox.addEventListener("change", function() {
            cambiarClase(checkbox);
        });
    });
}

function cambiarClase(checkbox) {
    const card = checkbox.closest(".card");
    if (card) {
        const checkedCheckboxes = card.querySelectorAll("input[type='checkbox']:checked");
        if (checkedCheckboxes.length > 0) {
            card.classList.add("active-card");
            card.classList.remove("inactive-card");
        } else {
            card.classList.add("inactive-card");
            card.classList.remove("active-card");
        }
    }
}
