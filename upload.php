<?php 
require_once("assets/includes/header.php");
require_once("assets/includes/classes/videoDetailsForm.php");
?>

<div class="column">

<?php
$form = new videoDetailsForm($con);
echo $form->createUploadForm();


?>

</div>

<script>
$("form").submit(function() {
    $("#loadingModal").modal("show");
});
</script>



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        Uploading.....
        <img src="assets/images/icons/loading-spinner.gif">
      </div>

    </div>
  </div>
</div>

<?php require_once("assets/includes/footer.php");?>
      