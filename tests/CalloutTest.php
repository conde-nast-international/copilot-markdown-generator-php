<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Callout;
require_once 'CopilotTagTest.php';

class CalloutTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Callout("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
