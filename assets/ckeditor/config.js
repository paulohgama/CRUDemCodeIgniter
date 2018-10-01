/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
        config.removeButtons = 'Save,NewPage,Preview,Source,Templates,Print,PasteFromWord,Find,SelectAll,Replace,Cut,Copy,Paste,PasteText,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,CreateDiv,Checkbox,Superscript,Subscript,Language,Anchor,SpecialChar,Iframe,Maximize,ShowBlocks,About';
        config.filebrowserBrowseUrl = '../assets/ckeditor/ckfinder/ckfinder.html';
        config.filebrowserImageBrowseUrl = '../assets/ckeditor/ckfinder/ckfinder.html?type=Images';
        config.filebrowserFlashBrowseUrl = '../assets/ckeditor/ckfinder/ckfinder.html?type=Flash';
        config.filebrowserUploadUrl = '../assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
        config.filebrowserImageUploadUrl = '../assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
        config.filebrowserFlashUploadUrl = '../assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
