---
title: Overview
---

# PHPGenesis/OpenFeature

The PHPGenesis OpenFeature is an abstraction layer on top of the [Open Feature PHP SDK](https://github.com/open-feature/php-sdk).

### Installation

To install the Open Feature package, you can use Composer:

```bash
composer require phpgenesis/open-feature
```

### Usage

This example will show how to check a feature flag with a boolean value. For documentation on how to configure an Open Feature Provider, please refer to the
[Open Feature Documentation](https://openfeature.dev/docs/reference/technologies/server/php)

```php
use PHPGenesis\OpenFeature\OpenFeature;

if (OpenFeature::bool('YOUR_FEATURE_NAME')) {
    // Your Feature Goes Here
}

```

### Available Methods

The following methods are provided.

```php
use PHPGenesis\OpenFeature\OpenFeature;

OpenFeature:::bool('YOUR_FEATURE_NAME');
OpenFeature:::string('YOUR_FEATURE_NAME');
OpenFeature:::int('YOUR_FEATURE_NAME');
OpenFeature:::float('YOUR_FEATURE_NAME');
OpenFeature:::object('YOUR_FEATURE_NAME');

```

### Sensible Defaults

Each method takes three parameters. Only the first parameter, used to identify the feature flag, is required.

- **Flag Key**: The string used to identify the feature flag.
- **Default Value**: The value to use if the feature flag cannot be resolved.
- **Evaluation Context**: Additional information to pass to the feature flag provider.

**Evaluation Context** defaults to null if not provided.

The **Default Value** default changes based on the method used. The defaults are listed below.

| Method Name | Default Value |
|-------------|---------------|
| bool        | false         |
| string      | ''            |
| int         | 0             |
| float       | 0.00          |
| object      | []            |