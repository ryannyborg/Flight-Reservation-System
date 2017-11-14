<?php
// This controller acts as the go between the view and the model.
//
// Author Ryan Nyborg
//
include 'searchModel.php';  // for $theDBA, an instance of DataBaseAdaptor
$id = htmlspecialchars($_GET["id"]);

	$arr = $theDBA->getReservations($id);
	echo  json_encode($arr);
?>
