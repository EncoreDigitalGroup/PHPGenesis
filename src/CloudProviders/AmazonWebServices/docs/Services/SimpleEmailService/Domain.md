---
title: Domain
---

# Domain Class Documentation

The `Domain` class is part of the `PHPGenesis\Services\AmazonWebServices\SimpleEmailService` namespace. This class provides methods to interact with the AWS Simple Email
Service (SES) specifically for domain-related operations.

## Class Properties

- `public string $domain`: This property holds the domain name that will be used in the AWS SES operations.

## Class Methods

### getSesClient()

```php
public static function getSesClient(): SesClient
```

This method is used to get an instance of the `SesClient` from the AWS SDK. It uses the `AwsClientConfiguration::get()` method to get the configuration for the client.

### verifyDomainIdentity()

```php
public function verifyDomainIdentity(): Result|string
```

This method is used to verify the domain identity with AWS SES. It uses the `verifyDomainIdentity` method of the `SesClient` with the domain property of the class. If the
operation is successful, it returns a `Result` object from the AWS SDK. If there is an error, it catches the `AwsException` and returns the error message as a string.

### verifyDomainDkim()

```php
public function verifyDomainDkim(): array|string
```

This method is used to verify the DKIM settings of the domain with AWS SES. It uses the `verifyDomainDkim` method of the `SesClient` with the domain property of the
class. If the operation is successful, it returns the `DkimTokens` as an array. If there is an error, it catches the `AwsException` and returns the error message as a
string.

## Usage

To use this class, you need to instantiate it and then call the methods you need. Here is an example:

```php
$domain = new Domain();
$domain->domain = 'yourdomain.com';
$result = $domain->verifyDomainIdentity();
```

In this example, we are verifying the domain identity of 'yourdomain.com'. The `$result` variable will hold the result of the operation.