<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListTag;

class ListTagTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect plain text" => [
                new ListTag(["Hello world!"]),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                ListTag::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                ListTag::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                ListTag::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                ListTag::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect string argument to throw InvalidArgumentException" => [
                ListTag::class,
                ["Hello world!"],
                InvalidArgumentException::class
            ]
        ];
    }
}
