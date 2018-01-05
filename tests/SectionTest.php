<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect section" => [
                new Section(),
                "\n-=-=-=-\n"
            ]
        ];
    }
}
