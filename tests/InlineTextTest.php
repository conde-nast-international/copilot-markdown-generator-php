<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\InlineText;

class InlineTextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new InlineText("Hello world!"),
                "Hello world!"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                InlineText::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                InlineText::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
