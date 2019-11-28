
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');
window.select2 = require('select2');
//feather.replace();
var slugify = function(text){
	return text.toString().toLowerCase()
	.replace(/\s+/g, '-') //replace spaces with -
	.replace(/[^\W\-]+/g, '') //remove all non-word
	.replace(/\-\-+/g, '-') // replace multiple - with -
	.replace(/^-+/, '')  //Trim - from all the text
	.replace(/-+$/, '')  // Trim -from end of the text
	
}
