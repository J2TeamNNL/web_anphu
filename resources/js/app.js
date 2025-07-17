// Laravel config JS (axios, lodash, csrf...)
import './bootstrap';

// jQuery
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import 'select2/dist/js/select2.min.js';
import 'select2/dist/css/select2.min.css';

import 'bootstrap';

$(document).ready(function () {
    console.log('jQuery version:', $.fn.jquery); // Kiểm tra jQuery có hoạt động
    console.log('Select2 exists:', typeof $.fn.select2); // Phải là 'function'

    $('.select2').select2({
        placeholder: 'Chọn danh mục...',
        allowClear: true,
        width: '100%',
    });
});
