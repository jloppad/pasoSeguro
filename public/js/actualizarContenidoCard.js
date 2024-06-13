document.addEventListener('DOMContentLoaded', function() {
    setInterval(updateRegistros, 2500);
});

function updateRegistros() {
    fetch('/exterior/datos')
        .then(response => response.text())
        .then(html => {
            document.getElementById('registros-container').innerHTML = html;
            initControlarLlave();
            initCambiarColorCard();
        })
        .catch(error => console.error('Error actualizando los registros:', error));
}