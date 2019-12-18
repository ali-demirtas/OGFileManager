<?php
// Preload the first 10 documents to not call via AJAX when the user open the first time the media manager
$listOfFilesByPage = Filesystem::listFiles(PATH_UPLOADS.'documents'.DS, '*', '*', MEDIA_MANAGER_SORT_BY_DATE, MEDIA_MANAGER_NUMBER_OF_FILES);
$preLoadFiles = array();
if (!empty($listOfFilesByPage[0])) {
	foreach ($listOfFilesByPage[0] as $file) {
		$filename = Filesystem::filename($file);
		array_push($preLoadFiles, $filename);
	}
}

// Amount of pages for the paginator
$numberOfPages = count($listOfFilesByPage);
?>

<div id="jsDocumentManagerModal" class="modal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="container-fluid">
<div class="row">
	<div class="col p-3">
	<!--
		UPLOAD INPUT
	-->
		<h3 class="mt-2 mb-3"><i class="fa fa-file"></i><?php $L->p('FileManager'); ?></h3>

		<div id="jsalertMedia" class="alert alert-warning d-none" role="alert"></div>

		<!-- Form and Input file -->
		<form name="bluditFormUpload" id="jsOGFormUpload" enctype="multipart/form-data">
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="jsdocuments" name="documents[]" multiple>
				<label class="custom-file-label" for="jsdocuments"><?php $L->p('Choose files to upload'); ?></label>
			</div>
		</form>

		<!-- Progress bar -->
		<div class="progress mt-2">
			<div id="jsbluditProgressBar" class="progress-bar bg-primary" role="progressbar" style="width:0%"></div>
		</div>

	<!--
		IMAGES LIST
	-->
		<!-- Table for list files -->
		<table id="jsbluditMediaTable" class="table mt-2">
			<tr>
				<td><?php $L->p('There are no documents'); ?></td>
			</tr>
		</table>

		<!-- Paginator -->
		<nav>
			<ul class="pagination justify-content-center flex-wrap">
				<?php for ($i=1; $i<=$numberOfPages; $i++): ?>
				<li class="page-item"><button type="button" class="btn btn-link page-link" onClick="getFiles(<?php echo $i ?>)"><?php echo $i ?></button></li>
				<?php endfor; ?>
			</ul>
		</nav>

	</div>
</div>
</div>
</div>
</div>
</div>

<script>
function openMediaManager() {
	$('#jsDocumentManagerModal').modal('show');
}

function closeMediaManager() {
	$('#jsDocumentManagerModal').modal('hide');
}
</script>