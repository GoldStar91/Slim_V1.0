<?php
require 'vendor/autoload.php';
require 'class/Class1.php';
require 'class/Class2.php';
$app = new \Slim\Slim();

// get user route
$app->get('/getuser/userId/:userid', function ($userid) {
	$class1 = new Class1();
	$data = $class1::getUser($userid);
    echo $data;
});

//get order route
$app->get('/getorder/orderId/:orderid', function ($orderid) {
	$class2 = new Class2();
	$data = $class2::getOrder($orderid);
    echo $data;
});

//cancel order route
$app->get('/cancelorder/orderId/:orderid', function ($orderid) {
	$class2 = new Class2();
	$data = $class2::cancelOrder($orderid);
    echo $data;
});

$app->run();