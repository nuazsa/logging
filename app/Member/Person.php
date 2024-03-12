<?php

namespace Nuazsa\Logging\Member;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Person
{
    private string $person;
    private Logger $logger;

    public function __construct() {
        $this->logger = new Logger(Person::class);
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '../../../log/my_app.log'));
        $this->logger->pushHandler(new FirePHPHandler());
    }

    public function setPerson(string $person)
    {
        $this->person = $person;
        $this->logger->info('Set Person',['name' => $person]);
    }

    public function getPerson()
    {
        $person = $this->person;
        $this->logger->info('Get Person',['name' => $person]);

        return $person;
    }
}
