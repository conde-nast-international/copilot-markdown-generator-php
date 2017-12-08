<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\HR;

class HRTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new HR(),
                "\n----------\n"
            ]
        ];
    }
}
