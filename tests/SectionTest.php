<?php
namespace CopilotTags\Tests;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect section" => array(
                new Section(),
                "\n-=-=-=-\n"
            )
        );
    }
}
