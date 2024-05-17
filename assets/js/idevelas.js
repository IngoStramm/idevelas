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


    document.addEventListener('DOMContentLoaded', function () {
        ivFormsValidation();
        iv_newsletter_form();
        ivGoBackBtn();
    });
})();