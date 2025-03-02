document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const toggleBtn = document.getElementById('toggleBtn');

    toggleBtn.addEventListener('click', function() {
        navbar.classList.toggle('expanded');
    });
});
