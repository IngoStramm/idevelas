(() => {
    'use strict';

    function iv_show_alert(formAlertId, alertPlaceholder, message, type) {
        console.log(message);
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div id="${formAlertId}" class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');
        alertPlaceholder.append(wrapper);
    }


    function ivFormsValidation() {
        const forms = document.querySelectorAll('.needs-validation');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }

    function iv_newsletter_form() {
        const newsletterForms = document.querySelectorAll('.newsletter-form');
        newsletterForms.forEach(newsletterForm => {
            newsletterForm.addEventListener('submit', e => {
                e.preventDefault();

                const formAlertId = 'newsletter-form-alert';

                if (typeof document.getElementById(formAlertId) !== undefined && document.getElementById(formAlertId)) {
                    const newsletterFormAlert = bootstrap.Alert.getOrCreateInstance(`#${formAlertId}`);
                    newsletterFormAlert.close();
                }

                if (!newsletterForm.checkValidity()) {
                    return;
                }
                newsletterForm.classList.add('was-validated');

                const emailInput = newsletterForm.querySelector('#email');
                const btn = newsletterForm.querySelector('button');

                if (typeof btn === undefined || !btn) {
                    return;
                }

                if (btn.disabled) {
                    return;
                }
                btn.disabled = true;
                const originalBtntext = btn.innerText;
                btn.innerText = 'Enviando...';

                const ajaxUrl = ajax_object.ajax_url;
                const data = new FormData(newsletterForm);
                const action = data.get('action');

                // console.log(data.get('action'));

                for (const [key, value] of data) {
                    console.log('data', `${key}: ${value}\n`);
                }

                const alertPlaceholder = document.getElementById('newsletter-form-alert-placeholder');

                fetch(ajaxUrl, {
                    method: 'POST',
                    body: data
                })
                    .then((response) => response.json())
                    .then((response) => {
                        iv_show_alert(formAlertId, alertPlaceholder, response.data.msg, 'success');
                        emailInput.value = '';
                    })
                    .catch((error) => {
                        console.error(error);
                        iv_show_alert(alertPlaceholder, error, 'danger');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerText = originalBtntext;
                        newsletterForm.classList.remove('was-validated');
                    });

            });
        });
    }

    function ivGoBackBtn() {
        const goBackBtns = document.querySelectorAll('.go-back-btn');
        Array.from(goBackBtns).forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                history.back();
            });
        });
    }


    function ivMultiLevelDropdownMenu() {
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function () {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                });
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
                element.addEventListener('click', function (e) {
                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        if (nextEl.style.display === 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            });
        }
    }

    function ivProductCarousels() {
        const carousels = document.querySelectorAll('.product-carousel');
        for (const carousel of carousels) {
            const bsCarousel = new bootstrap.Carousel(`#${carousel.id}`);
        }
    }

    function ivQtyProductInput() {
        const qtyWrapper = document.querySelectorAll('.qty-wrapper');
        qtyWrapper.forEach(e => {
            const btnMinus = e.querySelector('.minus-qty');
            const btnPlus = e.querySelector('.plus-qty');
            const qtyInput = e.querySelector('.qty');

            if (typeof btnMinus !== undefined && btnMinus) {
                ivChangeQtyValue(btnMinus, qtyInput);
            }

            if (typeof btnPlus !== undefined && btnPlus) {
                ivChangeQtyValue(btnPlus, qtyInput);
            }
        });
    }

    function ivChangeQtyValue(btn, qtyInput) {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let newValue = qtyInput.value;
            if (btn.classList.contains('minus-qty')) {
                newValue--;
            } else {
                newValue++;
            }
            if (newValue <= 0) {
                newValue = 0;
            }
            const classesQtyInputs = qtyInput.classList.value;
            const classesArray = classesQtyInputs.split(' ');
            let cssSelector = '';
            classesArray.forEach(item => {
                cssSelector += `.${item}`;
            });
            const allInputs = document.querySelectorAll(cssSelector);
            allInputs.forEach(item => {
                item.value = newValue;
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        ivFormsValidation();
        iv_newsletter_form();
        ivGoBackBtn();
        ivProductCarousels();
        ivQtyProductInput();
    });
})();

// jQuery
jQuery(document).ready(function ($) {
    function ivSlickCarouselInit() {
        const nextArrow = `<button type="button" class="slick-next"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.2 9.79501L2.2 0.795013L0.399997 2.59501L7.6 9.79501L0.399997 16.995L2.2 18.795L11.2 9.79501Z" fill="white" stroke="white" stroke- width="0.18" /></button>
        </svg >`;
        const prevArrow = `<button type="button" class="slick-prev"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.799988 9.79501L9.79999 18.795L11.6 16.995L4.39999 9.79501L11.6 2.59501L9.79999 0.795013L0.799988 9.79501Z" fill="white" stroke="white" stroke-width="0.18"/></button>
        </svg>`;

        const defaultSettings = {
            infinite: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            nextArrow: nextArrow,
            prevArrow: prevArrow,
            arrows: true
        };

        $('.product-slider').slick(defaultSettings);

        $('.produto-depoimentos-carrossel').slick({
            ...defaultSettings,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }]
        });

        $('.produto-historia-carrossel').slick({ ...defaultSettings, arrows: false, autoplay: true });

        $('.produto-descricao-carrossel').slick({ ...defaultSettings, arrows: false, autoplay: true });

        $('.produto-categoria-carrossel').slick({ ...defaultSettings, arrows: false, autoplay: true });

        $('.home-banner').slick({ ...defaultSettings, dots: false, autoplay: true });
    }

    function ivAddToCartEvent() {
        $(document.body).on('added_to_cart', function () {
            // offcanvasMinicart
            const offcanvasMinicart = new bootstrap.Offcanvas('#offcanvasMinicart');
            offcanvasMinicart.show();
            console.log('adding_to_cart');
        });
    }
    ivSlickCarouselInit();
    ivAddToCartEvent();
});
