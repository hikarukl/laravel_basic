import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor.js';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold.js';
import CKFinder from '@ckeditor/ckeditor5-ckfinder/src/ckfinder.js';
import CKFinderUploadAdapter from '@ckeditor/ckeditor5-adapter-ckfinder/src/uploadadapter.js';
import Code from '@ckeditor/ckeditor5-basic-styles/src/code.js';
import CodeBlock from '@ckeditor/ckeditor5-code-block/src/codeblock.js';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials.js';
import FontBackgroundColor from '@ckeditor/ckeditor5-font/src/fontbackgroundcolor.js';
import FontColor from '@ckeditor/ckeditor5-font/src/fontcolor.js';
import FontFamily from '@ckeditor/ckeditor5-font/src/fontfamily.js';
import FontSize from '@ckeditor/ckeditor5-font/src/fontsize.js';
import Heading from '@ckeditor/ckeditor5-heading/src/heading.js';
import Highlight from '@ckeditor/ckeditor5-highlight/src/highlight.js';
import Image from '@ckeditor/ckeditor5-image/src/image.js';
import Indent from '@ckeditor/ckeditor5-indent/src/indent.js';
import IndentBlock from '@ckeditor/ckeditor5-indent/src/indentblock.js';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic.js';
import Link from '@ckeditor/ckeditor5-link/src/link.js';
import Strikethrough from '@ckeditor/ckeditor5-basic-styles/src/strikethrough.js';
import Subscript from '@ckeditor/ckeditor5-basic-styles/src/subscript.js';
import Superscript from '@ckeditor/ckeditor5-basic-styles/src/superscript.js';
import Underline from '@ckeditor/ckeditor5-basic-styles/src/underline.js';


import cash from "cash-dom";

let editorConfig = {
    plugins: [
        Bold,
        CKFinder,
        CKFinderUploadAdapter,
        Code,
        CodeBlock,
        Essentials,
        FontBackgroundColor,
        FontColor,
        FontFamily,
        FontSize,
        Heading,
        Highlight,
        Image,
        Indent,
        IndentBlock,
        Italic,
        Link,
        Strikethrough,
        Subscript,
        Superscript,
        Underline
    ],
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            '|',
            'codeBlock',
            'outdent',
            'indent',
            '|',
            'undo',
            'redo',
            'fontFamily',
            'fontSize',
            'fontColor',
            'fontBackgroundColor',
            'underline',
            'strikethrough',
            'code',
            'subscript',
            'superscript',
            'highlight',
            'CKFinder'
        ]
    },
    ckfinder: {
        // Upload the images to the server using the CKFinder QuickUpload command.
        uploadUrl: 'http://personal.local/ckfinder/upload?type=Images&responseType=json',
        openerMethod: 'popup'
    }
};

cash(".editor").each(function () {
    let editor = ClassicEditor;
    let options = editorConfig;
    let el = this;

    editor
        .create(el, options)
        .then((editor) => {
            if (cash(el).closest(".editor").data("editor") == "document") {
                cash(el)
                    .closest(".editor")
                    .find(".document-editor__toolbar")
                    .append(editor.ui.view.toolbar.element);
                window.editor = editor;
            }
        })
        .catch((error) => {
            console.error(error.stack);
        });

    if (cash(this).attr("name")) {
        window[cash(this).attr("name")] = editor;
    }
});
