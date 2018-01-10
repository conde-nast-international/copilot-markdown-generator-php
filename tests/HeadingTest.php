<?php
namespace CopilotTags\Tests;
use CopilotTags\Heading;

class HeadingTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect text with heading level" => [
                new Heading("Hello world!", 3),
                "### Hello world!\n"
            ],
            "expect only whitespace to be removed" => [
                new Heading("  "),
                ""
            ],
            "expect empty string" => [
                new Heading(""),
                ""
            ],
            "expect empty string with heading level" => [
                new Heading("", 4),
                ""
            ],
            "expect text without heading level" => [
                new Heading("Hello world!"),
                "## Hello world!\n"
            ],
            "expect heading level below minimum to render at minimum" => [
                new Heading("Hello world!", 1),
                "## Hello world!\n"
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Heading::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Heading::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Heading::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Heading::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Heading::class,
                [[]],
                \InvalidArgumentException::class
            ],
            "expect null \$level argument to throw InvalidArgumentException" => [
                Heading::class,
                ["", NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$level argument to throw InvalidArgumentException" => [
                Heading::class,
                ["", FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$level argument to throw InvalidArgumentException" => [
                Heading::class,
                ["", TRUE],
                \InvalidArgumentException::class
            ],
            "expect array \$level argument to throw InvalidArgumentException" => [
                Heading::class,
                ["", []],
                \InvalidArgumentException::class
            ],
            "expect string \$level argument to throw InvalidArgumentException" => [
                Heading::class,
                ["", "Hello world!"],
                \InvalidArgumentException::class
            ]
        ];
    }
}
