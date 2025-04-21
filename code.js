document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.image img');
    const modal = document.querySelector('.modal');
    const modalImage = document.getElementById('modal-image');
    const closeBtn = document.querySelector('.close');

    images.forEach(image => {
        image.addEventListener('click', function () {
            modal.style.display = 'block';
            modalImage.src = this.src;
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});





