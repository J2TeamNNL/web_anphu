// Laravel config JS (axios, lodash, csrf...)
import './bootstrap';

// jQuery
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// Bootstrap 5
import 'bootstrap';

// Select2
import 'select2';
import 'select2/dist/css/select2.min.css';

document.addEventListener('DOMContentLoaded', function () {
    $('.select2').select2();
});