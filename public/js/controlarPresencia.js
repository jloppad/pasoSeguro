document.addEventListener('DOMContentLoaded', main);

function main() {
    const absentButtons = document.querySelectorAll('.card button');

    absentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = button.closest('.card');

            if (card.classList.contains('active-card')) {
                return;
            }

            if (card.classList.contains('absent-card')) {
                card.classList.remove('absent-card');
                card.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.disabled = false;
                });
                button.textContent = 'Ausente';
            } else {
                card.classList.add('absent-card');
                card.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.disabled = true;
                });
                button.textContent = 'Ausente';
            }
        });
    });
}