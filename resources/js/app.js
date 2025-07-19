// Laravel config JS (axios, lodash, csrf...)
import './bootstrap';

import $ from 'jquery';
import 'select2';

// Đảm bảo jQuery gắn vào window
window.$ = $;
window.jQuery = $;

$(document).ready(function () {
    $('.select2').select2({
        placeholder: 'Chọn danh mục...',
        allowClear: true,
        width: '100%',
    });
});



// -------------------------
// jQuery
// import $ from 'jquery';
// window.$ = $;
// window.jQuery = $;

// import 'select2';
// import 'select2/dist/css/select2.min.css';

// import 'bootstrap';

// $(document).ready(function () {
//     console.log('jQuery version:', $.fn.jquery); // Kiểm tra jQuery có hoạt động
//     console.log('Select2 exists:', typeof $.fn.select2); // Phải là 'function'

//     console.log('window.$:', window.$);
//     console.log('window.$.fn.select2:', typeof window.$.fn.select2);

//     $('.select2').select2({
//         placeholder: 'Chọn danh mục...',
//         allowClear: true,
//         width: '100%',
//     });
// });


