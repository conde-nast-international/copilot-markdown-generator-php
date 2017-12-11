# copilot-markdown-generator (PHP)

> Generator classes for Copilot-flavored Markdown tags.

This is a utility library for generating Copilot-flavored Markdown, created for
use in PHP implementations of the [Flyway Integration API].

## Install

Using Composer:
```shell
$ composer require conde-nast-international/copilot-markdown-generator
```

## Basic usage

```php
use CopilotTags\Text;

$tag = new Text("Hello world!");
$markdown = $tag->write();
echo $markdown;
// Hello world!
```

## Contributing

See the [Contributing] document for guidance on making contributions to the
project.

## See also

* [Copilot-flavored Markdown]
* [Copilot-flavored Markdown spec]
* [CommonMark]
* [CommonMark spec]
* [Flyway Integration API]
* [Get Composer][Composer]

[Contributing]: https://github.com/conde-nast-international/copilot-markdown-generator-php/blob/master/CONTRIBUTING.md
[Copilot-flavored Markdown]: https://github.com/conde-nast-international/copilot-markdown
[Copilot-flavored Markdown spec]: https://github.com/conde-nast-international/copilot-markdown/tree/master/specification
[CommonMark]: http://commonmark.org/
[CommonMark spec]: http://spec.commonmark.org/
[Flyway Integration API]: https://conde-nast-international.github.io/flyway-api-docs
[Composer]: https://getcomposer.org/
