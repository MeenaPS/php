<?php 
echo"<pre>";
echo $_FILES['upload']['name'];

if(isset($_POST['submit'])){


	     $myFile = $_FILES["upload"];
	    
	     $parts = pathinfo($myFile["name"]);
	    
		 $name = uniqid().".".$parts["extension"];


	$data = $_POST['crpimg'];
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);
	//$imageName = time().'.png';
	
	file_put_contents('upload/'.$name, $data);


}



?>