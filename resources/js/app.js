import './bootstrap';
import "flowbite";
import Editor from "@toast-ui/editor";
import "@toast-ui/editor/dist/toastui-editor.css";

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;


Alpine.plugin(focus);

Alpine.start();


// const editor = new Editor({
//   el: document.querySelector('#editor'),
//   height: '400px',
//   initialEditType: 'markdown',
//   placeholder: 'Write something cool!',

// });
