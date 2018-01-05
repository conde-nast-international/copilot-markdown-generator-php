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

## Contributing

See the [Contributing] document for guidance on making contributions to the
project.

## API

Classes in this library are namespaced in `CopilotTags` (e.g. `CopilotTags\Paragraph`).

### CopilotTag

Interface for tag generator classes.
* `CopilotTag->write()`

  Write tag contents to beautified Copilot-flavored Markdown.<br>
  **Return:** string (Markdown)

### Text

Generator for unformatted text. Given text value can contain any valid
Copilot-flavored Markdown.

```php
(new Text("Hello world!"))->write();
// "Hello world!"
```

* `new Text($text)`<br>
  ***text:*** string (Markdown)<br>

### Heading

Generator for [ATX headings](http://spec.commonmark.org/0.27/#atx-headings).

```php
(new Heading("Hello world!", 3))->write();
// "### Hello world!\n"
```

* `new Heading($text[, $level])`<br>
***text:*** string (Markdown)<br>
***level:*** int (default: `2`)

### Paragraph

Generator for [paragraphs](http://spec.commonmark.org/0.27/#paragraphs).

```php
(new Paragraph("Hello world!"))->write();
// "Hello world!\n\n"
```

* `new Paragraph($text)`<br>
  ***text:*** string (Markdown)<br>

### InlineText

Generator for inline text tags: [emphasis](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3111-emphasis), [strong](http://spec.commonmark.org/0.27/#emphasis-and-strong-emphasis), [subscript](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3110-subscript), [superscript](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#319-superscript) and
[delete](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#314-delete).

```php
(new InlineText("Hello world!", InlineTextDelimiter::EMPHASIS))->write();
// "*Hello world!*"
```

* `new InlineText($text[, $delimiter])`<br>
  ***text:*** string (Markdown)<br>
  ***delimiter:*** string (`InlineTextDelimiter`) (default: `""`)

#### InlineTextDelimiter

|Class Constant |Value |Also known as              |
|---------------|------|---------------------------|
|`EMPHASIS`     |`*`   |Italic, em                 |
|`STRONG`       |`**`  |Bold                       |
|`SUBSCRIPT`    |`~`   |Inferior, sub              |
|`SUPERSCRIPT`  |`^`   |Superior, super            |
|`DELETE`       |`~~`  |Strikethrough, Strike, Del |

### Link

Generator for [links](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#317-link).

```php
(new Link("Hello world!", "https://github.com/"))->write();
// "[Hello world!](https://github.com/)"
(new Link("Hello world!", "https://github.com/", array("foo"=>"bar")))->write();
// "[Hello world!](https://github.com/){: foo=\"bar\" }"
```

* `new Link([$text, $href, $attributes])`<br>
  ***text:*** string (Markdown) (default: `""`)<br>
  ***href:*** string (default: `""`)<br>
  ***attributes:*** array (default: `[]`)

### Blockquote

Generator for [block quotes](http://spec.commonmark.org/0.27/#block-quotes).

```php
(new Blockquote("Hello world!"))->write();
// "> Hello world!\n"
```

* `new Blockquote($text)`<br>
  ***text:*** string (Markdown)<br>

### ListTag

Generator for [lists](http://spec.commonmark.org/0.27/#lists).

```php
(new ListTag(["First", "Second"]))->write();
// "* First\n* Second\n\n"
(new ListTag(["First", "Second"], TRUE))->write();
// "1. First\n2. Second\n\n"
```

* `new ListTag($items[, $ordered])`<br>
  ***items:*** array (Markdown)<br>
  ***ordered:*** boolean (default: `FALSE`)

### Embed

Generator for [embeds](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#311-embed).

```php
<?php
(new Embed("https://github.com", EmbedSubtype::IFRAME))->write();
// "\n\n[#iframe: https://github.com]\n"
(new Embed("https://github.com", EmbedSubtype::IFRAME, "My caption."))->write();
// "\n\n[#iframe: https://github.com]|||My caption.|||\n"
```

* `new Embed($uri[, $subtype, $caption])`<br>
  ***uri:*** string<br>
  ***subtype:*** string (default: `EmbedSubtype::IFRAME`)<br>
  ***caption:*** string (default: `""`)

#### EmbedSubtype

Class constants for valid embed [subtypes](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3116-subtypes). See the [source file](https://github.com/conde-nast-international/copilot-markdown-generator-php/blob/master/src/EmbedSubtype.php) for reference.

### Callout

Generator for [callouts](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#312-callout).

```php
(new Callout("Hello world!", "type"))->write();
// "+++type\nHello world!\n+++\n"
```

* `new Callout($text[, $subtype])`<br>
  ***text:*** string (Markdown)<br>
  ***subtype:*** string (default: `""`)

### Section

Generator for [sections](https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#313-section).

```php
(new Section())->write();
// "\n-=-=-=-\n"
```

* `new Section()`

### HR

Generator for [thematic breaks](http://spec.commonmark.org/0.27/#thematic-breaks).

```php
(new HR())->write();
// "\n----------\n"
```

* `new HR()`

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
