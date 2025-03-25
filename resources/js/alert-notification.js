window.addEventListener('load', (event) => {
    window.setTimeout(() => {
        const alertNotificationElement = document.querySelector('#alertNotification');
        if (!alertNotificationElement) {
            return;
        }
        alertNotificationElement.classList.add('hide-alert');
        window.setTimeout(() => {
            alertNotificationElement.remove();
        }, 1000);
    }, 3000);
});
