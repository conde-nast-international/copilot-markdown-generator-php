<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\HR;

class HRTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect HR" => [
                new HR(),
                "\n----------\n"
            ]
        ];
    }
}
