@extends('admins.layouts.master')

@section('content')
<div class="container my-4">
    <h4>Cập nhập chính sách công ty</h4>

    <form
        action="{{ route('admin.settings.company.updatePolicy') }}"
        method="POST"
        enctype="multipart/form-data"
    >
    {{-- Component Quill --}}
        <div class="form-group">
            <x-editor 
                selector="#quill-editor"
                uploadTable="policies"
                toolbar="full"
                height="500px"
                placeholder="Nhập chính sách công ty"
                :uploadRoute="route('admin.media.uploadImage')"
                :content="old('content', $compnaySetting->policy_content ?? '')"
                textareaName="content"
            />
        </div>
    </form>
</div>
@endsection