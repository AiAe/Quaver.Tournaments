import loadash from 'lodash'
window._ = loadash

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import * as Popper from '@popperjs/core'
window.Popper = Popper;

import * as Bootstrap from 'bootstrap'
window.Bootstrap = Bootstrap;

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

if(tableLinks) {
    for (const tr of tableLinks) {
        const route = tr.dataset.route;
        if(route) {
            tr.addEventListener('click', function () {
                window.location = route;
            }.bind(route));
        }
    }
}
