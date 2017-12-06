# copilot-markdown-generator (PHP)

> Generator classes for Copilot-flavored Markdown tags.

This is a utility library for generating Copilot-flavored Markdown, created for
use in PHP implementations of the [Flyway Integration API].

## Install

Using Composer:
```
composer require conde-nast-international/copilot-markdown-generator
```

## Basic usage

```php
use CopilotTags\Text;

$tag = new Text("Hello world!");
$markdown = $tag->write();
echo $markdown;
// Hello world!
```

## See also

* [Copilot-flavored Markdown]
* [Copilot-flavored Markdown specification]
* [Flyway Integration API]

[Copilot-flavored Markdown]: https://github.com/conde-nast-international/copilot-markdown
[Copilot-flavored Markdown specification]: https://github.com/conde-nast-international/copilot-markdown/tree/master/specification
[Flyway Integration API]: https://conde-nast-international.github.io/flyway-api-docs
