<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\HR;

class HRTest extends CopilotTagTest
{
    public function expectedWrite()
    {
        return [
            [
                new HR(),
                "\n----------\n"
            ]
        ];
    }
}
