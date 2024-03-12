<?php

namespace Nuazsa\Logging;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Nuazsa\Logging\Member\Person;

class PersonTest extends TestCase
{

    private static Person $person;

    public function setUp(): void
    {
        self::$person = new Person;
    }

    public function testGetPerson()
    {
        self::$person->setPerson('joko');
        self::$person->setPerson('bodi');
        self::$person->setPerson('bimo');
        self::$person->setPerson('noni');
        self::$person->setPerson('Azis');
        Assert::assertEquals('Azis', self::$person->getPerson());
    }
}
