// resources/js/editors/blog.js
import {
    ClassicEditor,
    Essentials, Paragraph, Heading,
    Bold, Italic, Underline, Strikethrough, Code,
    Font, Highlight, RemoveFormat,
    Link, AutoLink,
    List, ListProperties, TodoList,
    Indent, IndentBlock, Alignment,
    BlockQuote, HorizontalLine,
    Image, ImageUpload, ImageInsert, AutoImage, PictureEditing,
    ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage,
    MediaEmbed,
    Table, TableToolbar, TableProperties, TableCellProperties, TableCaption, TableColumnResize,
    CodeBlock,
    FindAndReplace, SelectAll,
    PasteFromOffice,
    Autoformat,
    GeneralHtmlSupport,
    WordCount,
    SimpleUploadAdapter
  } from 'ckeditor5';
  
  import 'ckeditor5/ckeditor5.css'; // CSS bắt buộc (Vite sẽ tự chèn link)
  
  function mountBlogEditor(selector = '#editor') {
    const el = document.querySelector(selector);
    if (!el) return;
  
    const uploadUrl = el.dataset.uploadUrl; // lấy từ data-upload-url của textarea
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
  
    return ClassicEditor.create(el, {
      // Self-host (npm/ZIP) có thể dùng GPL. Từ v44+, licenseKey là bắt buộc.
      licenseKey: 'GPL',
  
      plugins: [
        Essentials, Paragraph, Heading,
        Bold, Italic, Underline, Strikethrough, Code,
        Font, Highlight, RemoveFormat,
        Link, AutoLink,
        List, ListProperties, TodoList,
        Indent, IndentBlock, Alignment,
        BlockQuote, HorizontalLine,
        Image, ImageUpload, ImageInsert, AutoImage, PictureEditing,
        ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage,
        MediaEmbed,
        Table, TableToolbar, TableProperties, TableCellProperties, TableCaption, TableColumnResize,
        CodeBlock,
        FindAndReplace, SelectAll,
        PasteFromOffice,
        Autoformat,
        GeneralHtmlSupport,
        WordCount,
        SimpleUploadAdapter
      ],
  
      toolbar: {
        items: [
          'undo','redo','|',
          'heading','|',
          'bold','italic','underline','strikethrough','code','highlight','removeFormat','|',
          'link','insertImage','mediaEmbed','blockQuote','horizontalLine','|',
          'bulletedList','numberedList','todoList','outdent','indent','alignment','|',
          'insertTable','|',
          'codeBlock','findAndReplace','selectAll'
        ],
        shouldNotGroupWhenFull: true
      },
  
      // Sửa đúng quy tắc fontSize (dùng số khi bật supportAllValues)
      fontFamily: { supportAllValues: true },
      fontSize: {
        options: [12, 14, 'default', 16, 18, 20, 24],
        supportAllValues: true
      },
  
      link: {
        addTargetToExternalLinks: true,
        decorators: {
          addNofollowToExternalLinks: {
            mode: 'automatic',
            callback: url => /^https?:\/\//.test(url),
            attributes: { rel: 'nofollow noopener noreferrer' }
          }
        }
      },
  
      simpleUpload: {
        uploadUrl: uploadUrl,
        headers: csrf ? { 'X-CSRF-TOKEN': csrf } : {}
      },
  
      mediaEmbed: { previewsInData: true },
  
      image: {
        toolbar: [
          'imageTextAlternative','|',
          'imageStyle:inline','imageStyle:block','imageStyle:side','|',
          'linkImage','|','resizeImage'
        ],
        styles: ['inline','block','side'],
        resizeUnit: '%'
      },
  
      table: {
        contentToolbar: [
          'tableColumn','tableRow','mergeTableCells',
          'tableProperties','tableCellProperties'
        ]
      },
  
      htmlSupport: {
        allow: [
          { name: 'iframe', attributes: ['src','width','height','allow','allowfullscreen','frameborder'] },
          { name: 'figure', attributes: true, classes: true, styles: true }
        ]
      },
  
      wordCount: {
        onUpdate: stats => {
          const elCounter = document.getElementById('word-count');
          if (!elCounter) return;
          const minutes = Math.max(1, Math.round(stats.words / 200));
          elCounter.textContent = `Từ: ${stats.words} • Ký tự: ${stats.characters} • Ước tính đọc: ${minutes} phút`;
        }
      }
    })
    .then(editor => { window.editor = editor; })
    .catch(console.error);
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    mountBlogEditor('#editor');
  });
  