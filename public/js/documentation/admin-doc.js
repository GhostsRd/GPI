/**
 * Admin Documentation JavaScript
 * Handle specific document management UI interactions
 */

document.addEventListener('livewire:load', function () {
    // Listen for custom dispatch events if needed
    window.addEventListener('open-doc-modal', event => {
        console.log('Doc Modal Opened');
    });

    window.addEventListener('close-doc-modal', event => {
        console.log('Doc Modal Closed');
    });
});
