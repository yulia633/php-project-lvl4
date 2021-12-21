require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const ujs = require('@rails/ujs');
ujs.start();
