<?php
namespace CopilotTags\Tests;
use CopilotTags\ThematicBreak;

class ThematicBreakTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return [
            "expect thematic break" => [
                new ThematicBreak(),
                "\n----------\n"
            ]
        ];
    }
}
