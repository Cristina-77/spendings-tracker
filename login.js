

document.addEventListener('DOMContentLoaded', function() {
    const popupLink = document.getElementById('popupLink1');
    const popup = document.getElementById('popup1');
    const closeBtn = document.getElementById('closeBtn');

    popupLink.addEventListener('click', function(event) {
        event.preventDefault(); 
        popup.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const popupLink = document.getElementById('popupLink2');
    const popup = document.getElementById('popup2');
    const closeBtn = document.getElementById('closeBtn');

    popupLink.addEventListener('click', function(event) {
        event.preventDefault();
        popup.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
});