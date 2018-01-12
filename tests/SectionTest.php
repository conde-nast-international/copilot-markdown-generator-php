<?php
namespace CopilotTags\Tests;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return [
            "expect section" => [
                new Section(),
                "\n-=-=-=-\n"
            ]
        ];
    }
}
