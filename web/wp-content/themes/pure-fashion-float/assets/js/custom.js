// Add id to all mitdenkt links / buttons
document.addEventListener('DOMContentLoaded', function() {
    [].forEach.call( document.querySelectorAll( '.sereslauncher' ), function ( a ) {
        a.id = 'sereslauncher';
    });
});

// Display pano script (via iframe) only once everything has loaded (to avoid page jump)
window.addEventListener('load', function() {
    [].forEach.call( document.querySelectorAll( '.pano' ), function ( pano ) {
        pano.style.display = 'block';
    });
});
