
<?php
//$data = "success";
//echo $data;

?>


  <title>PHP - jquery ajax crop image before upload using croppie plugins</title>
  
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  <!--<script src="js/jquery.js"></script>
  <script src="js/croppie.js"></script>
  <link rel="stylesheet" href="css/bootstrap-3.min.css">
  <link rel="stylesheet" href="css/croppie.css">-->


<?php

$data = '<div class="container">';
  $data .= '<div class="panel panel-default">';
    $data .= '<div class="panel-heading">Image Upload</div>';
    $data .= '<div class="panel-body">';

    $data .= '<form name="imgup" method="post" action="success.php" enctype="multipart/form-data" id="cform">';
    $data .= '<div class="row">';
    $data .='<div class="col-md-4 text-center">';
    $data .='<div id="edit-demo" style="width:350px;display:none"></div>';
    $data .='</div>';
    $data .='<div class="col-md-4" style="padding-top:30px;">';
    $data .='<strong>Select Image:</strong>';
    $data .='<br/>';
    $data .='<input type="file" id="upload" name="upload">';
    $data .='<input type="hidden" name="crpimg" value="" />';
    $data .='<button type="submit" name="submit" class="btn btn-success upload-result">Upload Image</button>';
    $data .='</div>';
    $data .='<div class="col-md-4" style="">';
    $data .='<div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
    </div>
  </div>';

    $data .='</form>';
    $data .='</div>';
  $data .='</div>';
echo $data .='</div>';
?>

<script type="text/javascript">
$uploadCrop = $('#edit-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () { 
  $("#edit-demo").css("display", "block");
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);
});



$('.upload-result').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
    jQuery("[name=crpimg]").val(resp);
    console.log(resp);
    html = '<img src="' + resp + '" />';
    $("#upload-demo-i").html(html);
    
    
  });
});


</script>


