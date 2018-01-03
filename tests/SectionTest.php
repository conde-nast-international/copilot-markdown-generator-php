<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect plain text" => [
                new Section("Hello world!"),
                "Hello world!\n-=-=-=-\n"
            ],
            "expect only whitespace to be removed" => [
                new Section("  "),
                "\n-=-=-=-\n"
            ],
            "expect empty string" => [
                new Section(""),
                "\n-=-=-=-\n"
            ],
            "expect no text" => [
                new Section(),
                "\n-=-=-=-\n"
            ]
        ];
    }
}
