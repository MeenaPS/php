<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    </head>
    <body>
        <script> 

        $(document).ready(function(){
          $("button").click(function(){
                $.ajax({url: "/imgcrop/result.php", 
                    success: function(result){
                        console.log(result);
                  $("#result").html(result);
                }
            });
          });
        });

            
        </script>
        <div id="result"></div>
        <button>Get External Content</button>
        
  </body>
</html>