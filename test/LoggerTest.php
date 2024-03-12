<?php

namespace Nuazsa\Logging;

use Monolog\Formatter\HtmlFormatter;
use Monolog\Formatter\JsonFormatter;
use Monolog\Level;
use Monolog\Logger;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;
use Nuazsa\Logging\Order\orders;
use PHPUnit\Util\Json;

class LoggerTest extends TestCase
{
    public function testLog()
    {
        // create logger
        $logger = new Logger(LoggerTest::class);

        // add some handler
        $logger->pushHandler(new StreamHandler(__DIR__ . '/log/my_app.log'));
        $logger->pushHandler(new FirePHPHandler());

        // add extra
        $logger->pushProcessor(function ($record) {
            $record->extra['dummy'] = 'Hello Dummy';

            return $record;
        });

        // use logger
        $logger->info('my logger is ready', [
            // add context
            'status' => 'processing'
        ]);
        Assert::assertNotNull($logger);
    }

    public function testChanel()
    {
        // create handlers
        $stream = new StreamHandler(__DIR__ . '/log/my_app.log');
        $firephp = new FirePHPHandler();

        // main logger
        $logger = new Logger('my_logger');
        $logger->pushHandler($stream);
        $logger->pushHandler($firephp);

        $logger->info('my logger is ready', [
            // add context
            'ststus' => 'processing'
        ]);


        // second logger
        $securityLogger = $logger->withName('security');

        $securityLogger->pushProcessor(function ($record) {
            $record->extra['login'] = true;

            return $record;
        });

        $securityLogger->info('my scurity is ready');

        Assert::assertNotNull($logger);
    }

    
    private Admins $admin;
    public function testFormatter()
    {
        // finally, create a formatter
        $formatter = new HtmlFormatter();

        // Create a handler
        $stream = new StreamHandler(__DIR__ . '/log/my_app.log', Level::Debug);
        $stream->setFormatter($formatter);

        // bind it to a logger object
        $securityLogger = new Logger('security');
        $securityLogger->pushHandler($stream);

        
        $this->admin = new Admins;
        $securityLogger->info('success login', [
            'username' => $this->admin->getName()
        ]);
        
        Assert::assertEquals('Nur Azis Saputra', $this->admin->getName());
    }
}
