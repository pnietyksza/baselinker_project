<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../data/spring.php';

use Baselinker\CourierPackage;

$courierPackage = new CourierPackage();
$package = $courierPackage->newPackage($order,$params);
$courierPackage->packagePDF('1');


// $courierPackage = new CourierPackage();
// $courierPackage->packagePDF('LS026865137NL', $params);
