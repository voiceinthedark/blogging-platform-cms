import './bootstrap';
import "flowbite";
// import Quill from 'quill';
// import BlotFormatter from 'quill-blot-formatter';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

// Quill.register('modules/blotFormatter', BlotFormatter);


Alpine.plugin(focus);

Alpine.start();
