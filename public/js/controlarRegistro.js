document.addEventListener('DOMContentLoaded', main);

function main() {
    document.querySelectorAll('.card input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.card');
            const studentId = card.dataset.studentId;
            const motivo = this.value;
            const isChecked = this.checked;
            const allCheckboxes = Array.from(card.querySelectorAll('input[type="checkbox"]')).map(checkbox => {
                return {
                    value: checkbox.value,
                    checked: checkbox.checked
                };
            });

            fetch('/registro/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    studentId: studentId,
                    motivo: motivo,
                    isChecked: isChecked,
                    allCheckboxes: allCheckboxes
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const horaSalidaElement = card.querySelector('.hora-salida');
                        const anyChecked = allCheckboxes.some(checkbox => checkbox.checked);

                        horaSalidaElement.innerHTML = '';

                        if (anyChecked && data.horaSalida) {
                            let icon = document.createElement('i');
                            icon.classList.add('fa-solid', 'fa-person-walking-dashed-line-arrow-right');
                            horaSalidaElement.appendChild(icon);
                            horaSalidaElement.appendChild(document.createTextNode(`  ${data.horaSalida}`));
                        }
                    }
                });
        });
    });

    update_all();
}

function update_all() {
    window.addEventListener('beforeunload', function(event) {
        fetch('/registro/update_all');
        event.returnValue = 'Hay registros abiertos. ¿Está seguro que desea salir?';
    });
}
