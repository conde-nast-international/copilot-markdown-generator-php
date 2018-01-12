<?php
namespace CopilotTags\Tests;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return [
            "expect single text line" => [
                new Blockquote("Hello world!"),
                "\n> Hello world!\n"
            ],
            "expect multiple text lines" => [
                new Blockquote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "\n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect multiple lines with leading and trailing whitespace preserved" => [
                new Blockquote("\n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n"),
                "\n> \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n"
            ],
            "expect whitespace to be preserved" => [
                new Blockquote("  "),
                "\n>   \n"
            ],
            "expect empty string" => [
                new Blockquote(""),
                "\n\n"
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the first line" => [
                new Blockquote("  \n"),
                "\n>   \n> \n"
            ],
            "expect multiple lines of whitespace only to be preserved with spaces on the last line" => [
                new Blockquote("\n  "),
                "\n> \n>   \n"
            ],
            "expect a single newline to be preserved" => [
                new Blockquote("\n"),
                "\n> \n> \n"
            ],
            "expect multiple newlines to be preserved" => [
                new Blockquote("\n\n\n\n"),
                "\n> \n> \n> \n> \n> \n"
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Blockquote::class,
                [[]],
                \InvalidArgumentException::class
            ]
        ];
    }
}
