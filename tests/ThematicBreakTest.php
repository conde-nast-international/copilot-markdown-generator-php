<?php
namespace CopilotTags\Tests;
use CopilotTags\ThematicBreak;

class ThematicBreakTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect thematic break" => array(
                new ThematicBreak(),
                "\n----------\n"
            )
        );
    }
}
