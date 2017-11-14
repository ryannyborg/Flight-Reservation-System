<?php
// This controller acts as the go between the view and the model.
//
// Author Ryan Nyborg
//
include 'searchModel.php';  // for $theDBA, an instance of DataBaseAdaptor
$id = htmlspecialchars($_GET["id"]);
$totalCost = htmlspecialchars($_GET["totalCost"]);
$tripType = htmlspecialchars($_GET["tripType"]);
$depart_id = htmlspecialchars($_GET["depart_id"]);
$return_id = htmlspecialchars($_GET["return_id"]);
$passengers = htmlspecialchars($_GET["passengers"]);



$theDBA->createReservation($id, $totalCost, $tripType, $depart_id, $return_id, $passengers );


?>
