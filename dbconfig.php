<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bus-tracer-firebase-adminsdk-ig91d-96489d99dc.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://bus-tracer.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();



?>