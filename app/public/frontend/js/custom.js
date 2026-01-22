const searchInput = document.getElementById('searchInput');
const items = document.querySelectorAll('.portfolio-item');

searchInput.addEventListener('keyup', function () {
    const value = this.value.toLowerCase();

    items.forEach(item => {
        const name = item.getAttribute('data-name');
        item.style.display = name.includes(value) ? 'block' : 'none';
    });
});
