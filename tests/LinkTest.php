<?php
namespace CopilotTags\Tests;
use CopilotTags\Link;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class LinkTest extends CopilotTagTest
{
    public static function expectedWrites()
    {
        $embedMarkdown = (new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption"))->write();

        return [
            "expect empty string with no arguments" => [
                new Link(),
                ""
            ],
            "expect empty string with empty text" => [
                new Link(""),
                ""
            ],
            "expect text with href" => [
                new Link("Hello world!", "http://li.nk"),
                "[Hello world!](http://li.nk)"
            ],
            "expect text with href and attribute" => [
                new Link("Hello world!", "http://li.nk", Array("target" => "_blank")),
                "[Hello world!](http://li.nk){: target=\"_blank\" }"
            ],
            "expect text with href and multiple attributes" => [
                new Link("Hello world!", "http://li.nk", Array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](http://li.nk){: target=\"_blank\" title=\"rawr\" }"
            ],
            "expect text with empty href and multiple attributes" => [
                new Link("Hello world!", "", Array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](){: target=\"_blank\" title=\"rawr\" }"
            ],
            "expect trailing whitespace in text to be moved outside of tag" => [
                new Link("Hello world!\n\n", "http://li.nk"),
                "[Hello world!](http://li.nk)\n\n"
            ],
            "expect leading and trailing whitespace in text to be moved outside of tag" => [
                new Link("  Hello world!\n\n", "http://li.nk"),
                "  [Hello world!](http://li.nk)\n\n"
            ],
            "expect only embed" => [
                new Link($embedMarkdown, "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ],
            "expect internal newline in text to be removed" => [
                new Link("Hello\nworld!", "http://li.nk"),
                "[Hello world!](http://li.nk)"
            ],
            "expect only multiple embeds" => [
                new Link("{$embedMarkdown}{$embedMarkdown}", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ],
            "expect text with embed at start and end" => [
                new Link("{$embedMarkdown}some text yo{$embedMarkdown}", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n[some text yo](http://li.nk)\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ],
            "expect text with embed at end" => [
                new Link("some text yo $embedMarkdown", "http://li.nk"),
                "[some text yo](http://li.nk) \n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ],
            "expect text with embed at start" => [
                new Link("$embedMarkdown some text yo", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            ],
            "expect text with embed" => [
                new Link("this is $embedMarkdown some text yo", "http://li.nk"),
                "[this is](http://li.nk) \n\n[#image:/photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            ],
            "expect href with trailing whitespace trimmed" => [
                new Link("Hello world!", "http://li.nk     "),
                "[Hello world!](http://li.nk)"
            ],
            "expect href with leading whitespace trimmed" => [
                new Link("Hello world!", "     http://li.nk"),
                "[Hello world!](http://li.nk)"
            ],
            "expect href with leading and trailing whitespace trimmed" => [
                new Link("Hello world!", "\n\nhttp://li.nk     "),
                "[Hello world!](http://li.nk)"
            ]
        ];
    }

    public static function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Link::class,
                [NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Link::class,
                [FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Link::class,
                [TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Link::class,
                [5],
                \InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Link::class,
                [[]],
                \InvalidArgumentException::class
            ],
            "expect null \$href argument to throw InvalidArgumentException" => [
                Link::class,
                ["", NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$href argument to throw InvalidArgumentException" => [
                Link::class,
                ["", FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$href argument to throw InvalidArgumentException" => [
                Link::class,
                ["", TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$href argument to throw InvalidArgumentException" => [
                Link::class,
                ["", 5],
                \InvalidArgumentException::class
            ],
            "expect array \$href argument to throw InvalidArgumentException" => [
                Link::class,
                ["", []],
                \InvalidArgumentException::class
            ],
            "expect \$href argument with internal whitespace to throw InvalidArgumentException" => [
                Link::class,
                ["", "http://li .nk"],
                \InvalidArgumentException::class
            ],
            "expect \$href argument with internal newline to throw InvalidArgumentException" => [
                Link::class,
                ["", "http://li\n.nk"],
                \InvalidArgumentException::class
            ],
            "expect null \$attributes argument to throw InvalidArgumentException" => [
                Link::class,
                ["", "", NULL],
                \InvalidArgumentException::class
            ],
            "expect boolean false \$attributes argument to throw InvalidArgumentException" => [
                Link::class,
                ["", "", FALSE],
                \InvalidArgumentException::class
            ],
            "expect boolean true \$attributes argument to throw InvalidArgumentException" => [
                Link::class,
                ["", "", TRUE],
                \InvalidArgumentException::class
            ],
            "expect number \$attributes argument to throw InvalidArgumentException" => [
                Link::class,
                ["", "", 5],
                \InvalidArgumentException::class
            ],
            "expect string \$attributes argument to throw InvalidArgumentException" => [
                Link::class,
                ["", "", ""],
                \InvalidArgumentException::class
            ]
        ];
    }
}
