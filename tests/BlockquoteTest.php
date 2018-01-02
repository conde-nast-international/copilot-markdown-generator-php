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
                new Blockquote("\n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n"),
                "> \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n"
            ],
            [
                new Blockquote("  "),
                ">   \n"
            ],
            [
                new Blockquote(""),
                ""
            ],
            [
                new Blockquote("  \n"),
                ">   \n> \n"
            ],
            [
                new Blockquote("\n  "),
                "> \n>   \n"
            ],
            [
                new Blockquote("\n"),
                "> \n> \n"
            ],
            [
                new Blockquote("\n\n\n\n"),
                "> \n> \n> \n> \n> \n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Blockquote::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Blockquote::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Blockquote::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Blockquote::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Blockquote::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
