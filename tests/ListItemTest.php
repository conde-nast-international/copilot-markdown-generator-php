<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\ListItem;
require_once 'CopilotTagTest.php';

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
