import loadash from 'lodash'

window._ = loadash

import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as Popper from '@popperjs/core'

window.Popper = Popper;

import * as Bootstrap from 'bootstrap'

window.Bootstrap = Bootstrap;

import SimpleMDE from 'simplemde/dist/simplemde.min';

window.SimpleMDE = SimpleMDE;

import 'flatpickr/dist/flatpickr';

import './plugins/livewire-sortable';

document.addEventListener("DOMContentLoaded", function (event) {
    Livewire.on('gotoTop', () => {
        window.scrollTo({
            top: 15,
            left: 15,
            behaviour: 'smooth'
        })
    });
});


const tableLinks = document.querySelectorAll('.table-link tbody tr');

if (tableLinks) {
    for (const tr of tableLinks) {
        const route = tr.dataset.route;
        const blank = tr.dataset.blank ?? "";
        if (route) {
            tr.addEventListener('click', function () {
                if (blank) {
                    window.open(route, "_blank");
                } else {
                    window.location = route;
                }
            }.bind(route));
        }
    }
}

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))

tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new Bootstrap.Tooltip(tooltipTriggerEl)
})
