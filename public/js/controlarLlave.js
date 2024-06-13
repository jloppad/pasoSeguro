function initControlarLlave() {
    document.querySelectorAll('.card input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.card');
            const studentId = card.dataset.studentId;
            const groupId = card.dataset.groupId;
            const descripcion = this.value;
            const isChecked = this.checked;

            fetch('/llave/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    studentId: studentId,
                    groupId: groupId,
                    descripcion: descripcion,
                    isChecked: isChecked
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const horaDejadaElement = card.querySelector('.hora-dejada');

                        if (isChecked && data.horaDejada) {
                            let icon = document.createElement('i');
                            icon.classList.add('fa-solid', 'fa-key');
                            horaDejadaElement.innerHTML = '';
                            horaDejadaElement.appendChild(icon);
                            horaDejadaElement.appendChild(document.createTextNode(` ${data.horaDejada}`));
                        } else {
                            horaDejadaElement.innerHTML = '';
                        }
                    }
                });
        });
    });
}

document.addEventListener('DOMContentLoaded', initControlarLlave);
