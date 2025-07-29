// Laravel config JS (axios, lodash, csrf...)
import './bootstrap';
import AOS from 'aos';
import $ from 'jquery';
import 'select2';

window.$ = $;
window.jQuery = $;

import 'aos/dist/aos.css'; // AOS CSS
import 'select2/dist/css/select2.css'; // Select2 CSS
AOS.init();

$(function () {
    $('.select2').select2({
        placeholder: 'Chọn danh mục...',
        allowClear: true,
        width: '100%',
    });
});