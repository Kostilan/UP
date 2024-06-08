require('./bootstrap');

// Инициализация CKEditor       
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
import '@ckeditor/ckeditor5-build-classic/build/translations/ru';

document.addEventListener("DOMContentLoaded", function() {
    ClassicEditor
        .create(document.querySelector('#review-text'), {
            language: 'ru'
        })
        .catch(error => {
            console.error(error);
        });
});
