# copilot-markdown-generator-php

## Install

Using Composer:
```
composer require conde-nast-international/copilot-markdown-generator
```

## Usage

```php
require 'vendor/autoload.php';

use CopilotTags\Text;

$tag = new Text("Hello world!");
$markdown = $tag->write();
echo $markdown;
// Hello world!
```
