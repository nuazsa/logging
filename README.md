# Using Monolog
 - [Installation](#installation)
 - [Logs Level](#logs-level)
 - [Configuring](#configuring)
 - [Adding extra](#adding-extra)
    - [Using context](#using-context)
    - [Using processors](#using-processors)
- [Customizing format](#customizing-format)
    - [Formater](#formater)
## Installation


with composer
``` terminal
composer require monolog/monolog
```

## Logs Level

| Type | Value | Description |
|------|-------|-------------|
|DEBUG |100| Detailed debug information|
|INFO |200| Interesting events. Examples: User logs in, SQL logs|
|NOTICE |250| Normal but significant events|
|WARNING |300| Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.|
|ERROR |400| Runtime errors that do not require immediate action but should typically be logged and monitored.|
|CRITICAL |500| Critical conditions. Example: Application component unavailable, unexpected exception|
|ALERT |550| Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.|

## Configuring

``` php
<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Level::Debug));
$logger->pushHandler(new FirePHPHandler());

// You can now use your logger
$logger->info('My logger is now ready');
```

## Adding extra

### Using context
``` php
<?php

$logger->info('Adding a new user', ['username' => 'Seldaek']);
```
### Using processors
``` php
<?php

$logger->pushProcessor(function ($record) {
    $record->extra['dummy'] = 'Hello world!';

    return $record;
});
```

## Customizing format
``` php
// finally, create a formatter
$formatter = new JsonFormatter();

// Create a handler
$stream = new StreamHandler(__DIR__.'/my_app.log', Level::Debug);
$stream->setFormatter($formatter);
```
### Formater
- LineFormatter
- HtmlFormatter
- NormalizerFormatter
- ScalarFormatter
- JsonFormatter
- WildfireFormatter
- ChromePHPFormatter
- GelfMessageFormatter
- LogstashFormatter
- ElasticaFormatter
- ElasticsearchFormatter
- LogglyFormatter
- MongoDBFormatter
- FluentdFormatter
- SyslogFormatter

---
Monolog Version: 3.5