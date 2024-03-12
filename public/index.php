<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nuazsa\Logging\Member\Person;

$person = new Person;

$person->setPerson('Azis');
echo $person->getPerson();