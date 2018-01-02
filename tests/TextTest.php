<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Text;

class TextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Text("Hello world!"),
                "Hello world!"
            ],
            [
                new Text("  "),
                "  "
            ],
            [
                new Text(""),
                ""
            ],
            [
                new Text("Hello\nworld!"),
                "Hello\nworld!"
            ],
            [
                new Text("Hello\n\n\n\nworld!"),
                "Hello\n\nworld!"
            ],
            [
                new Text("Hello\n       \nworld!"),
                "Hello\n\nworld!"
            ],
            [
                new Text("Hello\n\n\n       \nworld!"),
                "Hello\n\nworld!"
            ],
            [
                new Text("   \nHello\n\n\n       \nworld!"),
                "\nHello\n\nworld!"
            ],
            [
                new Text("Hello\n\n\n       \nworld!  \n    "),
                "Hello\n\nworld!  \n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Text::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Text::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Text::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Text::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Text::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
