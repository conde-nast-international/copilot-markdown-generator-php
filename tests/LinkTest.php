<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Link;

class LinkTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Link("Hello world!"),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Link::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
