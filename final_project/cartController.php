<?php

// This controller acts as the go between the view and the model.
//
// Author Ryan Nyborg
//
include 'searchModel.php';  // for $theDBA, an instance of DataBaseAdaptor
$depart_id = htmlspecialchars($_GET["depart_id"]);
$return_id = htmlspecialchars($_GET["return_id"]);

$arr = $theDBA->getCartItems($depart_id, $return_id);


echo  json_encode($arr);
?>