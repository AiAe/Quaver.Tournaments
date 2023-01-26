import loadash from 'lodash'
window._ = loadash

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import * as Popper from '@popperjs/core'
window.Popper = Popper

import 'bootstrap'

document.addEventListener("DOMContentLoaded", function (event) {
    Livewire.on('gotoTop', () => {
        console.log('owo');
        window.scrollTo({
            top: 15,
            left: 15,
            behaviour: 'smooth'
        })
    });
});
