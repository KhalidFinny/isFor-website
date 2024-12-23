$(document).ready(function () {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    $(entry.target).addClass('visible');
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });

    $('.document-item').each(function () {
        observer.observe(this);
    });
});