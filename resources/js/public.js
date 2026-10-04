// Only loaded by layouts.public: no Alpine/global shared bundle required.
const menu = document.querySelector('#public-nav');
const toggle = document.querySelector('.menu-toggle');
const mobile = window.matchMedia('(max-width: 680px)');
const setMenu = (open) => {
    menu.hidden = mobile.matches && !open;
    toggle.setAttribute('aria-expanded', String(mobile.matches && open));
    toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
};
if (menu && toggle) {
    setMenu(false);
    toggle.addEventListener('click', () => setMenu(toggle.getAttribute('aria-expanded') !== 'true'));
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));
    mobile.addEventListener('change', () => setMenu(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            setMenu(false);
            toggle.focus();
        }
    });
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.public-header')) setMenu(false);
    });
}
const markBroken = (image) => {
    image.hidden = true;
    const frame = image.closest('[data-image-frame]');
    const fallback = frame?.querySelector('.media-fallback');
    if (fallback) {
        fallback.hidden = false;
        // A present URL that failed is not the same as missing CMS content.
        const caption = fallback.querySelector('span:last-child');
        if (caption) caption.textContent = 'Gambar tidak dapat dimuat';
    }
};
document.querySelectorAll('[data-managed-image]').forEach((image) => {
    image.addEventListener('error', () => markBroken(image));
    if (image.complete && image.naturalWidth === 0) markBroken(image);
});
// Clear, visible active navigation without blocking native anchor behavior.
if ('IntersectionObserver' in window) {
    const links = [...document.querySelectorAll('.public-nav a')];
    const observer = new IntersectionObserver((entries) => {
        for (const entry of entries) {
            if (!entry.isIntersecting) continue;
            links.forEach((link) => {
                if (link.hash === `#${entry.target.id}`) link.setAttribute('aria-current', 'location');
                else link.removeAttribute('aria-current');
            });
        }
    }, { rootMargin: '-15% 0px -65% 0px', threshold: 0 });
    document.querySelectorAll('main section[id]').forEach((section) => observer.observe(section));
}
if (document.querySelector('.form-notice')) {
    document.querySelector('#contact')?.scrollIntoView();
}
