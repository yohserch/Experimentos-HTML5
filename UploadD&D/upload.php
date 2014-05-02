<?php 

header('Content-Type: application/json');

if(!empty($_FILES['file']['name'][0])){
	foreach($_FILES['file']['name'] as $position => $name){
		$tmpName = $_FILES['file']['tmp_name'][$position];
		if(move_uploaded_file($tmpName, 'Uploads/'.$name)){
			$uploaded[] = array(
				'name' => $name,
				'file' => 'Uploads/'.$name,
			);
		}else{
			$uploaded = array(
				'mensaje' => 'Error al subir los archivos'
			);
		}
	}
	echo json_encode($uploaded);
}else{
	$uploaded = array(
		'mensaje' => 'Error al leer archivos'
	);
	echo json_encode($uploaded);
}


 ?>