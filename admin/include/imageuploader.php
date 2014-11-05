<div >
<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
<!-- Redirect browsers with JavaScript disabled to the origin page -->
<noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
<div class="row fileupload-buttonbar">
<div class="col-lg-8">
<!-- The fileinput-button span is used to style the file input field as button -->
<span class="btn btn-success fileinput-button">
<i class="fa fa-plus-circle"></i>
<span>Add files...</span>
<input type="file" name="files[]" multiple>
</span>
<button type="submit" class="btn btn-primary start">
<i class="fa fa-upload"></i>
<span>Start upload</span>
</button>
<button type="reset" class="btn btn-warning cancel">
<i class="fa fa-ban"></i>
<span>Cancel upload</span>
</button>
<button type="button" class="btn btn-danger delete">
<i class="fa fa-trash"></i>
<span>Delete</span>
</button>
<input type="checkbox" class="toggle">
<!-- The global file processing state -->
<span class="fileupload-process"></span>
</div>
<!-- The global progress state -->
<div class="col-lg-4 fileupload-progress fade">
<!-- The global progress bar -->
<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
<div class="progress-bar progress-bar-success" style="width:0%;"></div>
</div>
<!-- The extended global progress state -->
<div class="progress-extended">&nbsp;</div>
</div>
</div>
<!-- The table listing the files available for upload/download -->
<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
</form>
<br>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Image upload notes</h3>
</div>
<div class="panel-body">
<ul>
<li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default file size is unlimited).</li>
<li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
<li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
</ul>
</div>
</div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
<div class="slides"></div>
<h3 class="title"></h3>
<a class="prev">‹</a>
<a class="next">›</a>
<a class="close">×</a>
<a class="play-pause"></a>
<ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-upload fade">
	<td>
	<span class="preview"></span>
	</td>
	<td>
	<p class="name">{%=file.name%}</p>
	<strong class="error text-danger"></strong>
	</td>
	<td>
	<p class="size">Processing...</p>
	<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
	</td>
	<td>
	{% if (!i && !o.options.autoUpload) { %}
		<button class="btn btn-primary start" disabled>
		<i class="fa fa-upload"></i>
		<span>Start</span>
		</button>
		{% } %}
	{% if (!i) { %}
		<button class="btn btn-warning cancel">
		<i class="fa fa-ban"></i>
		<span>Cancel</span>
		</button>
		{% } %}
	</td>
	</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-download fade">
	<td>
	<span class="preview">
	{% if (file.thumbnailUrl) { %}
		<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
		{% } %}
	</span>
	</td>
	<td>
	<p class="name">
	{% if (file.url) { %}
		<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
		{% } else { %}
		<span>{%=file.name%}</span>
		{% } %}
	</p>
	{% if (file.error) { %}
		<div><span class="label label-danger">Error</span> {%=file.error%}</div>
		{% } %}
	</td>
	<td>
	<span class="size">{%=o.formatFileSize(file.size)%}</span>
	</td>
	<td>
	{% if (file.deleteUrl) { %}
		<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
		<i class="fa fa-trash"></i>
		<span>Delete</span>
		</button>
		<input type="checkbox" name="delete" value="1" class="toggle">
		{% } else { %}
		<button class="btn btn-warning cancel">
		<i class="fa fa-ban"></i>
		<span>Cancel</span>
		</button>
		{% } %}
	</td>
	</tr>
	{% } %}
</script>


<script src="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/blueimp/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->


<?php
/*
?>
<script src="<?php echo ROOT_WWW;?>admin/imageuploader/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<?php
*/
?>
<script>
$(function () {
	// Initialize the jQuery File Upload widget:
	$('#fileupload').fileupload({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
url: '<?php echo ROOT_WWW;?>admin/imageuploader/server/php/index.php?table=<?php echo $table;?>&id_item=<?php echo $id_item;?>'
	});
	// Enable iframe cross-domain access via redirect option:
	$('#fileupload').fileupload(
	'option',
	'redirect',
	window.location.href.replace(
	/\/[^\/]*$/,
	'/cors/result.html?%s'
	)
	);
	if (window.location.hostname === 'blueimp.github.io') {
		// Demo settings:
		$('#fileupload').fileupload('option', {
url: '//jquery-file-upload.appspot.com/',
			// Enable image resizing, except for Android and Opera,
			// which actually support image resizing, but fail to
			// send Blob objects via XHR requests:
disableImageResize: /Android(?!.*Chrome)|Opera/
			.test(window.navigator.userAgent),
maxFileSize: 5000000,
acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
		});
		// Upload server status check for browsers with CORS support:
		if ($.support.cors) {
			$.ajax({
url: '//jquery-file-upload.appspot.com/',
type: 'HEAD'
			}).fail(function () {
				$('<div class="alert alert-danger"/>')
				.text('Upload server currently unavailable - ' +
				new Date())
				.appendTo('#fileupload');
			});
		}
	} else {
		// Load existing files:
		$('#fileupload').addClass('fileupload-processing');
		$.ajax({
			// Uncomment the following to send cross-domain cookies:
			//xhrFields: {withCredentials: true},
url: $('#fileupload').fileupload('option', 'url'),
dataType: 'json',
context: $('#fileupload')[0]
		}).always(function () {
			$(this).removeClass('fileupload-processing');
		}).done(function (result) {
			$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
		});
	}
});
</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
