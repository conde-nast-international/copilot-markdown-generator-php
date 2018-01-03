<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

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
            ],
            [
                new Embed("http://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed(""),
                ""
            ],
            [
                new Embed("https://www.google.com", EmbedSubtype::IFRAME, "some caption"),
                "\n\n[#iframe:https://www.google.com]|||some caption|||\n"
            ],
            [
                new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n"
            ],
            [
                new Embed(" https://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed("https://www.google.com "),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed(" https://www.google.com "),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed("https://www.google.com\n"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed("\nhttps://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed("\nhttps://www.google.com\n"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            [
                new Embed("  "),
                ""
            ],
            [
                new Embed("  \n"),
                ""
            ],
            [
                new Embed("\n  "),
                ""
            ],
            [
                new Embed("\n"),
                ""
            ],
            [
                new Embed("\n\n\n\n"),
                ""
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Embed::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                [[]],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                ["http:// www.google.com"],
                InvalidArgumentException::class
            ],
            [
                Embed::class,
                ["http://\nwww.google.com"],
                InvalidArgumentException::class
            ]
        ];
    }
}
