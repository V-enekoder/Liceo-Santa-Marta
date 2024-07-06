import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    const openalertchanges = document.querySelector("#open-alert-changes");
    const closealertchanges = document.querySelector("#close-alert-changes");
    const alertchanges = document.querySelector("#alert-changes");

    if (openalertchanges && closealertchanges && alertchanges) {
        openalertchanges.addEventListener("click", () => {
            alertchanges.showModal();
        });

        closealertchanges.addEventListener("click", () => {
            alertchanges.close();
        });
    } else {
        console.error('No se encontraron todos los elementos necesarios en el DOM.');
    }
});