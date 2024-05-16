(() => {
    'use strict';
    function inputMasks() {
        const inputTelefone = document.getElementById('iv_fone');
        const maskOptionsTelefone = {
            mask: '(00) 0000-0000[0]'
        };
        if (typeof inputTelefone !== undefined && inputTelefone) {
            const maskTelefone = IMask(inputTelefone, maskOptionsTelefone);
        }

        const inputWhatsApp = document.getElementById('iv_whatsapp');
        const maskOptionsWhatsApp = {
            mask: '+55 (00) 0000-00000'
        };
        if (typeof inputWhatsApp !== undefined && inputWhatsApp) {
            const maskWhatsApp = IMask(inputWhatsApp, maskOptionsWhatsApp);
        }

        const inputInscricaoEstadual = document.getElementById('iv_inscricao_estadual');
        const maskOptionsInscricaoEstadual = {
            mask: '00.000.000/0000-00'
        };
        if (typeof inputInscricaoEstadual !== undefined && inputInscricaoEstadual) {
            const maskWhatsApp = IMask(inputInscricaoEstadual, maskOptionsInscricaoEstadual);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        inputMasks();
    }, false);
})();