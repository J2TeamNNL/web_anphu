// Laravel config JS (axios, lodash, csrf...)
import './bootstrap';

import $ from 'jquery';
import 'select2';

window.$ = $;
window.jQuery = $;

$(function () {
    $('.select2').select2({
        placeholder: 'Chọn danh mục...',
        allowClear: true,
        width: '100%',
    });
});