<?php
namespace CopilotTags\Tests;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        $embedMarkdown = EmbedTest::getExampleMarkdown();
        return [
            "expect single text line" => [
                new Blockquote("Hello world!"),
                "> Hello world!\n"
            ],
            "expect multiple text lines" => [
                new Blockquote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect multiple lines with leading and trailing whitespace-only lines removed" => [
                new Blockquote("\n  \n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n   "),
                "> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect internal whitespace-only lines to be preserved" => [
                new Blockquote("The city’s central computer told you?\n\n\nR2D2,\n      \n \nyou know better than to trust a strange computer!"),
                "> The city’s central computer told you?\n> \n> \n> R2D2,\n>       \n>  \n> you know better than to trust a strange computer!\n"
            ],
            "expect only whitespace to be removed" => [
                new Blockquote("  "),
                ""
            ],
            "expect empty string" => [
                new Blockquote(""),
                ""
            ],
            "expect multiple whitespace-only lines to be removed with spaces on the first line" => [
                new Blockquote("  \n"),
                ""
            ],
            "expect multiple whitespace-only lines to be removed with spaces on the last line" => [
                new Blockquote("\n  "),
                ""
            ],
            "expect a single newline to be removed" => [
                new Blockquote("\n"),
                ""
            ],
            "expect multiple newlines to be removed" => [
                new Blockquote("\n\n\n\n"),
                ""
            ],
            "expect embed to terminate blockquote" => [
                new Blockquote("Hello $embedMarkdown world!"),
                "> Hello \n\n[#image:/photos/123ID]|||some caption|||\n\n>  world!\n"
            ],
            "expect only embed" => [
                new Blockquote($embedMarkdown),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ],
            "expect embed with leading and trailing whitespace-only lines removed" => [
                new Blockquote("\n  \n\n\n  \nHello $embedMarkdown world!\n \n\n"),
                "> Hello \n\n[#image:/photos/123ID]|||some caption|||\n\n>  world!\n"
            ]
        ];
    }

    public static function expectedBeautifys()
    {
        return [
            "expect only empty lines to be removed" => [
                Blockquote::class,
                ">\n>\n>\n",
                ""
            ],
            "expect whitespace-only block quote to be removed" => [
                Blockquote::class,
                ">        \n>\n>      \n> \n>     \n",
                ""
            ],
            "expect whitespace-only block quote to be removed with surrounding newlines" => [
                Blockquote::class,
                "\n\n>        \n>\n>      \n> \n>     \n\n\n\n",
                "\n\n"
            ],
            "expect whitespace-only block quote to be removed with surrounding text" => [
                Blockquote::class,
                "Hello\n>        \n>\n>      \n> \n>     \nworld!",
                "Hello\n\nworld!"
            ],
            "expect whitespace-only block quote to be removed with surrounding text and whitespace" => [
                Blockquote::class,
                " \n\n   \nHello\n\n>        \n>\n>      \n> \n>     \nworld!\n\n  \n  ",
                "\n\nHello\n\nworld!\n\n"
            ],
            "expect surrounding whitespace-only block quote lines to be removed" => [
                Blockquote::class,
                "> \n>   \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n>    \n",
                "> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            "expect internal whitespace-only block quote lines to be preserved" => [
                Blockquote::class,
                "> The city’s central computer told you?\n> \n> \n> R2D2,\n>       \n>  \n> you know better than to trust a strange computer!\n",
                "> The city’s central computer told you?\n> \n> \n> R2D2,\n>       \n>  \n> you know better than to trust a strange computer!\n"
            ],
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
