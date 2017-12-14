<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Link;

class LinkTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        $assetMarkdown = "\n\n[#image: /photos/123ID]|||some caption|||\n";

        return [
            [
                new Link(),
                ""
            ],
            [
                new Link(""),
                ""
            ],
            [
                new Link("Hello world!", "http://li.nk"),
                "[Hello world!](http://li.nk)"
            ],
            [
                new Link("Hello world!", "http://li.nk", Array("target" => "_blank")),
                "[Hello world!](http://li.nk){: target=\"_blank\" }"
            ],
            [
                new Link("Hello world!", "http://li.nk", Array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](http://li.nk){: target=\"_blank\" title=\"rawr\" }"
            ],
            [
                new Link("Hello world!", null, Array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](){: target=\"_blank\" title=\"rawr\" }"
            ],
            [
                new Link("Hello world!\n\n", "http://li.nk"),
                "[Hello world!](http://li.nk)\n\n"
            ],
            [
                new Link("  Hello world!\n\n", "http://li.nk"),
                "  [Hello world!](http://li.nk)\n\n"
            ],
            [
                new Link("  Hello world!\n\n", "http://li\n.nk"),
                "  [Hello world!](http://li.nk)\n\n"
            ],
            [
                new Link("Hello world!", "http://li.nk     "),
                "[Hello world!](http://li.nk)"
            ],
            [
                new Link($assetMarkdown, "http://li.nk"),
                "$assetMarkdown"
            ],
            [
                new Link("Hello\nworld!", "http://li.nk"),
                "[Hello](http://li.nk)\n[world!](http://li.nk)"
            ],
            [
                new Link("{$assetMarkdown}{$assetMarkdown}", "http://li.nk"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n[#image: /photos/123ID]|||some caption|||\n"
            ],
            [
                new Link("{$assetMarkdown}some text yo{$assetMarkdown}", "http://li.nk"),
                "{$assetMarkdown}[some text yo](http://li.nk){$assetMarkdown}"
            ],
            [
                new Link("some text yo $assetMarkdown", "http://li.nk"),
                "[some text yo](http://li.nk) $assetMarkdown"
            ],
            [
                new Link("$assetMarkdown some text yo", "http://li.nk"),
                "{$assetMarkdown} [some text yo](http://li.nk)"
            ],
            [
                new Link("this is $assetMarkdown some text yo", "http://li.nk"),
                "[this is](http://li.nk) {$assetMarkdown} [some text yo](http://li.nk)"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            [
                Link::class,
                [NULL],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [5],
                InvalidArgumentException::class
            ],
            [
                Link::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
