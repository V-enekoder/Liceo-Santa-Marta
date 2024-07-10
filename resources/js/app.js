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

document.addEventListener("DOMContentLoaded", () => {
    const openalertchangesedit = document.querySelector("#open-alert-edit");
    const closealertchangesedit = document.querySelector("#close-alert-edit");
    const alertchangesedit = document.querySelector("#alert-edit");

    if (openalertchangesedit && closealertchangesedit && alertchangesedit) {
        openalertchangesedit.addEventListener("click", () => {
            alertchangesedit.showModal();
        });

        closealertchangesedit.addEventListener("click", () => {
            alertchangesedit.close();
        });
    } else {
        console.error('No se encontraron todos los elementos necesarios en el DOM.');
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const openaddrepresentante = document.querySelector("#open-add-representante");
    const closeaddrepresentante = document.querySelector("#close-add-representante");
    const addrepresentante = document.querySelector("#add-representante");

    if (openaddrepresentante && closeaddrepresentante && addrepresentante) {
        openaddrepresentante.addEventListener("click", () => {
            addrepresentante.showModal();
        });

        closeaddrepresentante.addEventListener("click", () => {
            addrepresentante.close();
        });
    } else {
        console.error('No se encontraron todos los elementos necesarios en el DOM.');
    }
});