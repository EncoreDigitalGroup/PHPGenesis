---
title: Configuration
---

# AwsConfig Class Documentation

The `AwsConfig` class is part of the `PHPGenesis\Services\AmazonWebServices\Config` namespace. This class provides methods to interact with the AWS configuration
settings.

## Class Properties

- `public ?object $credentials`: This property holds the AWS credentials. It is an object that contains `key` and `secret` properties.
- `public string $region`: This property holds the AWS region. The default value is 'us-east-1'.
- `public string $version`: This property holds the AWS version. The default value is '2010-12-01'.

## Usage

To use this class, you need to instantiate it. Here is an example:

```php
$awsConfig = new AwsConfig();
```

In this example, we are creating a new instance of `AwsConfig`. The `$awsConfig` variable will hold the instance of the class. The AWS credentials, region, and version
are automatically set during instantiation.