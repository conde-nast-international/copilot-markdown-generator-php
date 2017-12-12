<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListTag;

class ListTagTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new ListTag(["Hello world!"]),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                ListTag::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                ListTag::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                ListTag::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                ListTag::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                ListTag::class,
                ["my string"],
                InvalidArgumentException::class
            ]
        ];
    }
}
