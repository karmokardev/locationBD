if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/pwa/service-worker.js')
            .then(reg => console.log('Service Worker registered:', reg))
            .catch(err => console.log('Service Worker registration failed:', err));
    });
}

let deferredPrompt;

// Check if user previously closed it
const isClosed = localStorage.getItem('pwaInstallClosed');

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    // Show only if not previously closed
    if (!isClosed) {
        const installBox = document.getElementById('pwaInstallBox');
        if (installBox) installBox.style.display = 'flex';
    }
});

// Install button click
document.querySelectorAll('.installBtn').forEach(btn => {
    btn.addEventListener('click', async () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;

            console.log(`User response to install: ${outcome}`);

            deferredPrompt = null;

            document.getElementById('pwaInstallBox').style.display = 'none';

            // If installed, prevent showing again
            if (outcome === 'accepted') {
                localStorage.setItem('pwaInstalled', 'true');
            }
        }
    });
});

// Close button click
document.querySelector('.pwa-close-btn')?.addEventListener('click', () => {
    document.getElementById('pwaInstallBox').style.display = 'none';

    // Save close state
    localStorage.setItem('pwaInstallClosed', 'true');
});