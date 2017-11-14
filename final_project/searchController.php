<?php
// This controller acts as the go between the view and the model.
//
// Author Ryan Nyborg
//
include 'searchModel.php';  // for $theDBA, an instance of DataBaseAdaptor
$originForm = $_GET["origin"];
$destinationForm = $_GET["destination"];
$depart = $_GET["depart"];
$passengers = $_GET["passengers"];

if($originForm == "Phoenix, AZ (PHX)"){
	$origin = "PHX";
}
else if($originForm == "Dallas, TX (DFW)"){
	$origin = "DFW";
}
else if($originForm == "Atlanta, GA (ATL)"){
	$origin = "ATL";
}
else if($originForm == "Tokyo-Narita, Japan (NRT)"){
	$origin = "NRT";
}
else if($originForm == "Seoul, South Korea (ICN)"){
	$origin = "ICN";
}
else{
	$origin = "error";
}

if($destinationForm == "Phoenix, AZ (PHX)"){
	$destination = "PHX";
}
else if($destinationForm == "Dallas, TX (DFW)"){
	$destination = "DFW";
}
else if($destinationForm == "Atlanta, GA (ATL)"){
	$destination = "ATL";
}
else if($destinationForm == "Tokyo-Narita, Japan (NRT)"){
	$destination = "NRT";
}
else if($destinationForm == "Seoul, South Korea (ICN)"){
	$destination = "ICN";
}
else{
	$destination = "error";
}

$arr = $theDBA->getFlights ($origin, $destination, $depart, $passengers);


echo  json_encode($arr);
?>
