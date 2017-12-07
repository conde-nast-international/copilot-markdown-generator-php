<?php

use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;
require_once 'CopilotTagTest.php';

class EmbedTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Embed("https://www.google.com", EmbedSubtype::VIDEO),
                "\n\n[#video:https://www.google.com]\n"
            ],
            [
                new Embed("https://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ]
        ];
    }
}
