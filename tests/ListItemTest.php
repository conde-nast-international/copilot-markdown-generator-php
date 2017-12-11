<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListItem;

class ListItemTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new ListItem("Hello world!"),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                ListItem::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                ListItem::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                ListItem::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                ListItem::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                ListItem::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
