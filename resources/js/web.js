/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.bootstrap = require('./bootstrap.bundle.min');


document.addEventListener("DOMContentLoaded", function (event) {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    const downloadButtons = document.getElementsByClassName("download-round");
    const downloadInGameButtons = document.getElementsByClassName("download-ingame-round");

    if (downloadButtons) {
        for (const button of downloadButtons) {
            button.addEventListener('click', downloadRound, false);
        }
    }

    if (downloadInGameButtons) {
        for (const button of downloadInGameButtons) {
            button.addEventListener('click', downloadInGameRound, false);
        }
    }

    function downloadRound() {
        const round = this.dataset.round;

        const maps = document.getElementById(round).getElementsByClassName('download');

        if (maps.length) {
            for (const map of maps) {
                window.open("https://quavergame.com/download/mapset/" + map.dataset.download);
            }
        }
    }

    function downloadInGameRound() {
        const round = this.dataset.round;

        const maps = document.getElementById(round).getElementsByClassName('download');

        if (maps.length) {
            for (const map of maps) {
                window.open("quaver://mapset/" + map.dataset.download);
            }
        }
    }

});
