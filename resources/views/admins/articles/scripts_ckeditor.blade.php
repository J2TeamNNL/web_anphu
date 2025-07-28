@push('styles')
<style>
  .ck-editor__editable[role="textbox"]{ min-height: 420px; }
</style>
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">

@vite('resources/js/editor.js')
@endpush