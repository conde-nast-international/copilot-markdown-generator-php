<?php
namespace CopilotTags\Tests;
use CopilotTags\Callout;

class CalloutTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect text with subtype" => [
                new Callout("Hello world!", "type"),
                "+++type\nHello world!\n+++\n"
            ],
            "expect text without subtype" => [
                new Callout("Hello world!"),
                "+++\nHello world!\n+++\n"
            ],
            "expect newlines to be preserved" => [
                new Callout("\n\nHello\nworld!\n"),
                "+++\n\nHello\nworld!\n\n+++\n"
            ],
            "expect only whitespace to be removed" => [
                new Callout("  "),
                ""
            ],
            "expect empty string" => [
                new Callout(""),
                ""
            ],
            "expect multiple whitespace-only lines to be removed with spaces on the first line" => [
                new Callout("  \n"),
                ""
            ],
            "expect multiple whitespace-only lines to be removed with spaces on the last line" => [
                new Callout("\n  "),
                ""
            ],
            "expect single newline to be removed" => [
                new Callout("\n"),
                ""
            ],
            "expect more than 2 newlines to be removed" => [
                new Callout("\n\n\n\n"),
                ""
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Callout::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Callout::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Callout::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Callout::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Callout::class,
                [[]],
                \InvalidArgumentException::class
            ],
            "expect null \$subtype argument to throw InvalidArgumentException" => [
                Callout::class,
                ["", NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$subtype argument to throw InvalidArgumentException" => [
                Callout::class,
                ["", FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$subtype argument to throw InvalidArgumentException" => [
                Callout::class,
                ["", TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$subtype argument to throw InvalidArgumentException" => [
                Callout::class,
                ["", 5],
                \InvalidArgumentException::class
            ],
            "expect array \$subtype argument to throw InvalidArgumentException" => [
                Callout::class,
                ["", []],
                \InvalidArgumentException::class
            ]
        ];
    }
}
