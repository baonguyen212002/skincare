// Thay đổi lại đúng tên font mình nhúng trong file fonts.css

CKEDITOR.editorConfig = function( config ) {

	config.contentsCss = '../assets/css/fonts.css';

	config.font_names = 'VCN;' + config.font_names;
//  // Tích hợp elFinder
//  config.filebrowserBrowseUrl = '/elfinder/elfinder.html';
//  config.filebrowserImageBrowseUrl = '/elfinder/elfinder.html?type=image';
//  config.filebrowserUploadUrl = '/elfinder/php/connector.minimal.php';
};
