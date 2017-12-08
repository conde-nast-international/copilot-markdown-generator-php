<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Section("Hello world!"),
                "Hello world!\n-=-=-=-\n"
            ],
            [
                new Section("  "),
                "  \n-=-=-=-\n"
            ],
            [
                new Section(""),
                "\n-=-=-=-\n"
            ],
            [
                new Section(),
                "\n-=-=-=-\n"
            ]
        ];
    }
}
