<?php
namespace CopilotTags\Tests;
use CopilotTags\HR;

class HRTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        return [
            "expect HR" => [
                new HR(),
                "\n----------\n"
            ]
        ];
    }
}
