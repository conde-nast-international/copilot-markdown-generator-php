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
}
