<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListItem;

class ListItemTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect plain text" => [
                new ListItem("Hello world!"),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                ListItem::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                ListItem::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                ListItem::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                ListItem::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array argument to throw InvalidArgumentException" => [
                ListItem::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
