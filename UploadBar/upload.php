<?php 

header('Content-Type: application/json');

$upload = [];
$allow = ['mp4', 'png', 'mp3', 'pdf'];

$succeeded = [];
$failed = [];

if(!empty($_FILES['file'])){
	foreach($_FILES['file']['name'] as $key => $name){
		if($_FILES['file']['error'][$key] === 0){
			$temp = $_FILES['file']['tmp_name'][$key];
			$ext = explode('.', $name);
			$ext = strtolower(end($ext));

			$file = md5_file($temp).time().'.'.$ext;

			if(in_array($ext, $allow) && move_uploaded_file($temp, 'uploads/'.$file)){
				$succeeded[] = array(
					'name' => $name,
					'file' => 'uploads/'.$file
				);
			}else{
				$failed[] = array(
					'name'=> $name
				);
			}
		}
	}

	if(!empty($_POST['ajax'])){
		echo json_encode(array(
			'succeeded' => $succeeded,
			'failed' => $failed
		));
	}

}


 ?>