document.addEventListener('DOMContentLoaded', main);

function main() {

    document.querySelectorAll('.card input[type="checkbox"]').forEach(checkbox => {

        checkbox.addEventListener('change', function() {
            const card = this.closest('.card');  // Obtiene el contenedor más cercano que tiene la clase "card"
            const studentId = card.dataset.studentId;  // Obtiene el ID del estudiante de un atributo de datos del contenedor
            const motivo = this.value;  // Obtiene el valor del checkbox, que es el motivo
            const isChecked = this.checked;  // Verifica si el checkbox está marcado
            const allCheckboxes = Array.from(card.querySelectorAll('input[type="checkbox"]')).map(checkbox => {
                return {
                    value: checkbox.value,
                    checked: checkbox.checked
                };
            });

            fetch('/registro/update', {
                method: 'POST',  // Método HTTP utilizado para la solicitud
                headers: {
                    'Content-Type': 'application/json',  // Tipo de contenido de la solicitud
                    'X-Requested-With': 'XMLHttpRequest',  // Indica que es una solicitud AJAX
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // Token CSRF para seguridad
                },
                body: JSON.stringify({
                    studentId: studentId,  // ID del estudiante
                    motivo: motivo,  // Motivo
                    isChecked: isChecked,  // Estado del checkbox (marcado o no)
                    allCheckboxes: allCheckboxes  // Estado de todos los checkboxes en la tarjeta
                })
            })
                .then(response => response.json())
        });
    });
    update_all();
}

function update_all() {
    // Agregar listener para beforeunload
    window.addEventListener('beforeunload', function(event) {
        fetch('/registro/update_all');
        // Mostramos una alerta para que el navegador espere a que se complete la solicitud
        event.returnValue = 'Hay registros abiertos. ¿Está seguro que desea salir?';
    });
}

