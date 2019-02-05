<?php 
try {
	symlink('/storage/app/public', '/public/storage');
	echo "string";
} catch (Exception $e) {
	print_r($e);
}

 ?>