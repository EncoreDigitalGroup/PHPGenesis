---
title: Logger
---

# PHPGenesis/Logger

The PHPGenesis Logger is an abstraction layer on top of the Laravel Log Facade and Monolog.

### Installation

To install the Logger package, you can use Composer:

```bash
composer require phpgenesis/logger
```

### Usage

**Note:** Changes are coming in PHPGenesis/Logger v0.3 that remove the Monolog specific implementation. Instead, PHPGenesis will implement the Laravel Log Facade for you
in any PHP project.

To log a message, use the `PHPGenesis\Logger\Logger` class.

```php
use PHPGenesis\Logger\Logger;
```

The following methods are available for you to use via `Logger`:

```php
$message = 'This is an example logger message';

Logger::debug($message);
Logger::info($message);
Logger::notice($message);
Logger::warning($message);
Logger::error($message);
Logger::critical($message);
Logger::alert($message);
Logger::emergency($message);
```

All methods all accept an additional optional parameter for context data. The context data must be an array and defaults to an empty array if not supplied

The `Logger` class will determine if the Laravel Log Facade is available and use it, otherwise it will use Monolog. If Laravel is available, the `Logger` class will use
the Laravel configuration settings for logging. Otherwise, `Logger` will use the settings configured in your `phpgenesis.json` file.