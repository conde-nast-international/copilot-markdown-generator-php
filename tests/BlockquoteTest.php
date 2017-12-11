<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Blockquote("Hello world!"),
                "> Hello world!\n"
            ],
            [
                new Blockquote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ],
            [
                new Blockquote("  "),
                ">   \n"
            ],
            [
                new Blockquote(""),
                ""
            ]
        ];
    }
}
