import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    const loader = document.querySelector('[data-page-loader]');
    document.body.classList.remove('preload');
    document.body.classList.add('page-ready');

    const initScrollAnimations = () => {
        const candidates = [
            ...document.querySelectorAll('[data-animate]'),
            ...document.querySelectorAll('main section'),
            ...document.querySelectorAll('main article'),
            ...document.querySelectorAll('main form'),
            ...document.querySelectorAll('main [data-animate-group] > *'),
        ];

        const unique = Array.from(new Set(candidates)).filter((node) => !node.hasAttribute('data-no-animate'));
        unique.forEach((node, index) => {
            node.classList.add('reveal-on-scroll');
            node.style.setProperty('--reveal-delay', `${Math.min(index * 35, 280)}ms`);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.16,
            rootMargin: '0px 0px -8% 0px',
        });

        unique.forEach((node) => observer.observe(node));
    };

    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
            setTimeout(initScrollAnimations, 120);
        }, 220);
    } else {
        setTimeout(initScrollAnimations, 80);
    }

    const links = document.querySelectorAll('a[href]');
    links.forEach((link) => {
        if (link.target === '_blank' || link.hasAttribute('download')) {
            return;
        }

        link.addEventListener('click', () => {
            if (loader) {
                loader.classList.remove('hidden');
                loader.classList.add('page-loader-linking');
            }
        });
    });
});
