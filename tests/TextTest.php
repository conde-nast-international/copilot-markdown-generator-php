<?php
namespace CopilotTags\Tests;
use CopilotTags\Text;

class TextTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect plain text" => [
                new Text("Hello world!"),
                "Hello world!"
            ],
            "expect only whitespace to be preserved" => [
                new Text("  "),
                "  "
            ],
            "expect empty string" => [
                new Text(""),
                ""
            ],
            "expect internal newline" => [
                new Text("Hello\nworld!"),
                "Hello\nworld!"
            ],
            "expect internal carriage return" => [
                new Text("Hello\rworld!"),
                "Hello\nworld!"
            ],
            "expect internal CRLF" => [
                new Text("Hello\r\nworld!"),
                "Hello\nworld!"
            ],
            "expect more than 2 newlines to be reduced to 2" => [
                new Text("Hello\n\n\n\nworld!"),
                "Hello\n\nworld!"
            ],
            "expect whitespace on a line with no non-whitespace characters to be removed" => [
                new Text("Hello\n       \nworld!"),
                "Hello\n\nworld!"
            ],
            "expect whitespace on a line with no non-whitespace characters to be removed and more than 2 newlines to be reduced to 2" => [
                new Text("Hello\n\n\n       \nworld!"),
                "Hello\n\nworld!"
            ],
            "expect whitespace on multiple lines with no non-whitespace characters to be removed and more than 2 newlines to be reduced to 2" => [
                new Text("Hello\n       \n\n       \nworld!"),
                "Hello\n\nworld!"
            ],
            "expect whitespace on the first line with no non-whitespace characters to be removed" => [
                new Text("   \nHello\n\n\n       \nworld!"),
                "\nHello\n\nworld!"
            ],
            "expect whitespace on the last line with no non-whitespace characters to be removed" => [
                new Text("Hello\n\n\n       \nworld!  \n    "),
                "Hello\n\nworld!  \n"
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Text::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Text::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Text::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Text::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Text::class,
                [[]],
                \InvalidArgumentException::class
            ]
        ];
    }
}
