// Activer les confirmations de suppression
document.querySelectorAll('[data-confirm]').forEach(button => {
    button.addEventListener('click', (event) => {
        if (!confirm(event.target.dataset.confirm)) {
            event.preventDefault();
        }
    });
});