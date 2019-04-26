<!DOCTYPE html>
<html>
<head>
<title>Crop Image</title>
<link rel="stylesheet" href="css/imgareaselect.css">
</head>
<style>
#previewimage{cursor: crosshair;}
</style>
<body>
<form action="crop.php" method="post" enctype="multipart/form-data">
    Upload Image: <input type="file" name="image" id="image"  onchange="readImage(this);" />
    <input type="hidden" name="x1" value="" />
    <input type="hidden" name="y1" value="" />
    <input type="hidden" name="w" value="" />
    <input type="hidden" name="h" value="" /><br><br>
    <input type="submit" name="submit" value="Submit" />
</form>
 
<p><img id="previewimage" style="display:none;"/></p>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="js/jquery.imgareaselect.js"></script>
<script>

function readImage(input1) {
    
    $("#previewimage").css("display", "block");
    if (input1.files && input1.files[0]) {
            var reader1 = new FileReader();

            reader1.onload = function (e) {
                $('#previewimage')
                    .attr('src', e.target.result);
            };

            reader1.readAsDataURL(input1.files[0]);
        }
    }

    jQuery(function($) {
 
        var p = $("#previewimage");
       /* $("body").on("change", "#image", function(){*/

        /*$("#image").on("change", function(){
 
            var imageReader = new FileReader();
            imageReader.readAsDataURL(document.getElementById("image").files[0]);
     
            imageReader.onload = function (oFREvent) {
                p.attr('src', oFREvent.target.result).fadeIn();
            };
        });*/


        
 
        $('#previewimage').imgAreaSelect({
            handles: true,
            onSelectEnd: function (img, selection) {
                $('input[name="x1"]').val(selection.x1);
                $('input[name="y1"]').val(selection.y1);
                $('input[name="w"]').val(selection.width);
                $('input[name="h"]').val(selection.height);            
            }
        });
    });
</script>

</body>
</html>



