<?php
namespace CopilotTags\Tests;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;
use CopilotTags\Heading;
use CopilotTags\Link;
use CopilotTags\InlineText;
use CopilotTags\InlineTextDelimiter;

class CompoundTagTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        $embed = new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption");
        // $strong = new InlineText("  Hello world!  ", InlineTextDelimiter::STRONG);
        return array(
            "expect heading containing only embed" => array(
                new Heading("$embed"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect heading containing embed with text after" => array(
                new Heading("$embed Hello world!"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n## Hello world!\n"
            ),
            "expect heading containing embed with text before" => array(
                new Heading("Hello world! $embed"),
                "\n\n## Hello world! \n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect heading containing embed with text before and after" => array(
                new Heading("Hello world! $embed It's me again"),
                "\n\n## Hello world! \n\n[#image:/photos/123ID]|||some caption|||\n\n## It's me again\n"
            ),
            "expect inline text conatining only embed" => array(
                new InlineText("$embed", ":"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect inline text conatining embed with text after" => array(
                new InlineText("$embed Hello world!", ":"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n :Hello world!:"
            ),
            "expect inline text conatining embed with text before" => array(
                new InlineText("Hello world! $embed", ":"),
                ":Hello world!: \n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect inline text conatining embed with text before and after" => array(
                new InlineText("Hello world! $embed It's me again", ":"),
                ":Hello world!: \n\n[#image:/photos/123ID]|||some caption|||\n\n :It's me again:"
            ),
            "expect link containing only embed" => array(
                new Link("$embed", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing internal newline in text to be removed" => array(
                new Link("Hello\nworld!", "http://li.nk"),
                "[Hello world!](http://li.nk)"
            ),
            "expect link containing only multiple embeds" => array(
                new Link("{$embed}{$embed}", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at start and end" => array(
                new Link("{$embed}some text yo{$embed}", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n[some text yo](http://li.nk)\n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at end" => array(
                new Link("some text yo $embed", "http://li.nk"),
                "[some text yo](http://li.nk) \n\n[#image:/photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at start" => array(
                new Link("$embed some text yo", "http://li.nk"),
                "\n\n[#image:/photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            ),
            "expect link containing text with embed" => array(
                new Link("this is $embed some text yo", "http://li.nk"),
                "[this is](http://li.nk) \n\n[#image:/photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            )
        );
    }
}
