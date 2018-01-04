# copilot-markdown-generator (PHP)

> Generator classes for Copilot-flavored Markdown tags.

This is a utility library for generating Copilot-flavored Markdown, created for
use in PHP implementations of the [Flyway Integration API].

## Install

Using [Composer]:

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

## API

Classes in this library are namespaced in the `CopilotTags` namespace (e.g. `CopilotTags\Paragraph`).

### CopilotTag
Interface for all tag generator classes.
* `CopilotTag::write`

  Write tag contents to Copilot-flavored Markdown.<br>
  **Return:** string (Markdown)

### Text

Generator for unformatted text and parent class of other text-based tag
generators. Text input can contain any valid Copilot-flavored Markdown.

```php
echo new Text("Hello world!")->write()
// "Hello world!"
```

**Implements:** `CopilotTag`

* `new Text($text)`<br>
  ***text:*** string (Markdown)<br>

### Heading

```php
echo new Heading("Hello world!", 3)->write()
// "### Hello world!"
```

**Extends:** `Text`

* `new Heading($text[, $level])`<br>
***text:*** string (Markdown)<br>
***level:*** int (default: `2`)

### Paragraph

```php
echo new Paragraph("Hello world!")->write()
// "Hello world!\n\n"
```

**Extends:** `Text`

* `new Paragraph($text)`<br>
  ***text:*** string (Markdown)<br>

### InlineText
Generator for inline text tags.

```php
echo new InlineText("Hello world!", InlineTextDelimiter::EMPHASIS)->write()
// "*Hello world!*"
```

**Extends:** `Text`

* `new InlineText($text[, $delimiter])`<br>
  ***text:*** string (Markdown)<br>
  ***delimiter:*** string (`InlineTextDelimiter`) (default: `""`)

### **InlineTextDelimiter**

```php
echo InlineTextDelimiter::STRONG
// "**"
```

|Name          |Value|
|--------------|-----|
|`EMPHASIS`    |`*`  |
|`STRONG`      |`**` |
|`SUBSCRIPT`   |`~`  |
|`SUPERSCRIPT` |`^`  |
|`DELETE`      |`~~` |

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
