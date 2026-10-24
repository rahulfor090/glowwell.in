/**
 * Glow Well Consultants Pvt. Ltd. - Main Frontend Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const mobileNavToggle = document.getElementById('mobileNavToggle');
    const mainNav = document.getElementById('mainNav');

    if (mobileNavToggle && mainNav) {
        mobileNavToggle.addEventListener('click', () => {
            mainNav.classList.toggle('mobile-active');
            const icon = mobileNavToggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
    }

    // 2. Mobile Dropdown Support
    const dropdownParents = document.querySelectorAll('.nav-item.has-dropdown');
    dropdownParents.forEach(item => {
        const link = item.querySelector('.nav-link');
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                item.classList.toggle('dropdown-open');
            }
        });
    });

    // 3. FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        if (questionBtn) {
            questionBtn.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close other items in the same accordion
                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                });

                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });

    // 4. FAQ Category Filter (if present)
    const faqFilterBtns = document.querySelectorAll('.faq-filter-btn');
    if (faqFilterBtns.length > 0) {
        faqFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                faqFilterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const targetCat = btn.getAttribute('data-target');

                faqItems.forEach(item => {
                    const itemCat = item.getAttribute('data-category');
                    if (targetCat === 'all' || itemCat === targetCat) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    // 5. Global Consultation Modal
    const modal = document.getElementById('consultationModal');
    const openModalBtns = document.querySelectorAll('.open-consultation-modal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    if (closeModalBtn && modal) {
        closeModalBtn.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    }

    // 6. Trademark Search Widget Interaction
    const tmSearchBtn = document.getElementById('tmSearchBtn');
    const tmSearchInput = document.getElementById('tmSearchInput');

    if (tmSearchBtn && tmSearchInput) {
        tmSearchBtn.addEventListener('click', () => {
            const query = tmSearchInput.value.trim();
            if (query) {
                window.location.href = `enquiry.php?service=trademark&query=${encodeURIComponent(query)}`;
            } else {
                tmSearchInput.focus();
            }
        });
        tmSearchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                tmSearchBtn.click();
            }
        });
    }

    // 7. Auto close alerts after 6 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 6000);
    });
});
