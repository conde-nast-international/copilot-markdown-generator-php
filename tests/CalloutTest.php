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
