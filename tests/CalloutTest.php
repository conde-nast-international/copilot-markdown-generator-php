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
                new Callout(),
                ""
            ],
            [
                new Callout("Hello world!"),
                "+++\nHello world!\n+++\n"
            ]
        ];
    }
}
