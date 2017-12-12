<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Callout;

class CalloutTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Callout("Hello world!", "type"),
                "+++type\nHello world!\n+++\n"
            ],
            [
                new Callout("  "),
                "  \n"
            ],
            [
                new Callout(""),
                ""
            ],
            [
                new Callout("Hello world!"),
                "+++\nHello world!\n+++\n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Callout::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Callout::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Callout::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Callout::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Callout::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
