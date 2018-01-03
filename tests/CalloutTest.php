<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Callout;

class CalloutTest extends CopilotTagTest
{
    public function expectedWrites()
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
                "\n"
            ],
            "expect empty string" => [
                new Callout(""),
                ""
            ],
            "expect spaces on the first line with no non-whitespace characters to be removed" => [
                new Callout("  \n"),
                "\n\n"
            ],
            "expect spaces on the last line with no non-whitespace characters to be removed" => [
                new Callout("\n  "),
                "\n\n"
            ],
            "expect single newline to be preserved" => [
                new Callout("\n"),
                "\n\n"
            ],
            "expect more than 2 newlines to become 2 newlines" => [
                new Callout("\n\n\n\n"),
                "\n\n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                Callout::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                Callout::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                Callout::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                Callout::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array argument to throw InvalidArgumentException" => [
                Callout::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
