/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import 'bootstrap';
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

require('summernote/dist/summernote-bs4.css');
require('summernote/dist/summernote-bs4.js');
require('summernote/dist/lang/summernote-fr-FR');

$('.summernote').summernote({
    lang: 'fr-FR',
    toolbar: [
        ['style'],
        ['font', ['bold', 'underline', 'superscript', 'subscript']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ],
    styleTags: [
        'p', 'h2', 'h3', 'pre'
    ]
});

$('[data-confirm]').on('click', function() {
    return confirm($(this).attr('data-confirm'));
});