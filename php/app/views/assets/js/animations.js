document.addEventListener('DOMContentLoaded', () => {
    // Initialize intersection observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                if (entry.target.classList.contains('stagger-children')) {
                    animateChildren(entry.target);
                }
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    // Animate children elements with delay
    function animateChildren(parent) {
        const children = parent.querySelectorAll('.stagger-item');
        children.forEach((child, index) => {
            child.style.animationDelay = `${index * 100}ms`;
            child.style.animationPlayState = 'running';
        });
    }

    // Observe all animated elements
    document.querySelectorAll('.fade-in, .slide-up, .slide-in-right, .slide-in-left, .scale-in, .stagger-children')
        .forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

    // Handle page transitions
    document.addEventListener('beforeunload', () => {
        document.body.classList.add('page-exit-active');
    });
}); 