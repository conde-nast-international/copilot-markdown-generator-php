<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class EmbedTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect embed with subtype" => [
                new Embed("https://www.google.com", EmbedSubtype::VIDEO),
                "\n\n[#video:https://www.google.com]\n"
            ],
            "expect embed with default subtype" => [
                new Embed("https://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with http uri converted to https" => [
                new Embed("http://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect empty string" => [
                new Embed(""),
                ""
            ],
            "expect embed with caption" => [
                new Embed("https://www.google.com", EmbedSubtype::IFRAME, "some caption"),
                "\n\n[#iframe:https://www.google.com]|||some caption|||\n"
            ],
            "expect image embed with caption and uri beginning with forward slash" => [
                new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n"
            ],
            "expect embed with leading whitespace in uri trimmed" => [
                new Embed(" https://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with trailing whitespace in uri trimmed" => [
                new Embed("https://www.google.com "),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with leading and trailing whitespace in uri trimmed" => [
                new Embed(" https://www.google.com "),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with trailing newline in uri trimmed" => [
                new Embed("https://www.google.com\n"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with leading newline in uri trimmed" => [
                new Embed("\nhttps://www.google.com"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect embed with leading and trailing newlines in uri trimmed" => [
                new Embed("\nhttps://www.google.com\n"),
                "\n\n[#iframe:https://www.google.com]\n"
            ],
            "expect empty string for only whitespace in uri" => [
                new Embed("  "),
                ""
            ],
            "expect empty string for only whitespace in uri and trailing newline" => [
                new Embed("  \n"),
                ""
            ],
            "expect empty string for only whitespace in uri and leading newline" => [
                new Embed("\n  "),
                ""
            ],
            "expect empty string for only newline in uri" => [
                new Embed("\n"),
                ""
            ],
            "expect empty string for only multiple newlines in uri" => [
                new Embed("\n\n\n\n"),
                ""
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                Embed::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                Embed::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                Embed::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                Embed::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array argument to throw InvalidArgumentException" => [
                Embed::class,
                [[]],
                InvalidArgumentException::class
            ],
            "expect uri argument with internal whitespace to throw InvalidArgumentException" => [
                Embed::class,
                ["http:// www.google.com"],
                InvalidArgumentException::class
            ],
            "expect uri argument with internal newline to throw InvalidArgumentException" => [
                Embed::class,
                ["http://\nwww.google.com"],
                InvalidArgumentException::class
            ]
        ];
    }
}
