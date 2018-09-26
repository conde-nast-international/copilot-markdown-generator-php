<?php
namespace CopilotTags\Tests;
use CopilotTags\Text;
use CopilotTags\Heading;
use CopilotTags\InlineText;
use CopilotTags\InlineTextDelimiter;
use CopilotTags\Link;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class CompoundTagTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        $embed = new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption");
        $strong = new InlineText("the middle of a sentence", InlineTextDelimiter::STRONG);
        $strong_spaced = new InlineText(" the middle of a sentence ", InlineTextDelimiter::STRONG);
        $link = new Link("some link text", "http://li.nk");
        $link_spaced = new Link(" some link text ", "http://li.nk");

        return array(
            "expect inline tag in the middle of the sentence to have correct spacing" => array(
                new Text("It's weird when there is an inline tag in{$strong_spaced}like this."),
                "It's weird when there is an inline tag in **the middle of a sentence** like this."
            ),
            "expect inline tag inside a link" => array(
                new Link("$strong", "http://li.nk"),
                "[**the middle of a sentence**](http://li.nk)"
            ),
            "expect inline tag inside a link with text before and after it" => array(
                new Link("Link with an inline tag in $strong, like this.", "http://li.nk"),
                "[Link with an inline tag in **the middle of a sentence**, like this.](http://li.nk)"
            ),
            "expect inline tag at the end of a link" => array(
                new Link("Link with an inline tag in $strong", "http://li.nk"),
                "[Link with an inline tag in **the middle of a sentence**](http://li.nk)"
            ),
            "expect inline tag at the start of a link" => array(
                new Link("$strong, like this.", "http://li.nk"),
                "[**the middle of a sentence**, like this.](http://li.nk)"
            ),
            "expect inline tag inside a link to have correct spacing" => array(
                new Link("$strong_spaced", "http://li.nk"),
                " [**the middle of a sentence**](http://li.nk) "
            ),
            "expect inline tag inside a link with text before and after it to have correct spacing" => array(
                new Link("Link with an inline tag in$strong_spaced, like this.", "http://li.nk"),
                "[Link with an inline tag in **the middle of a sentence** , like this.](http://li.nk)"
            ),
            "expect inline tag at the end of a link to have correct spacing" => array(
                new Link("Link with an inline tag in$strong_spaced", "http://li.nk"),
                "[Link with an inline tag in **the middle of a sentence**](http://li.nk) "
            ),
            "expect inline tag at the start of a link to have correct spacing" => array(
                new Link("$strong_spaced, like this.", "http://li.nk"),
                " [**the middle of a sentence** , like this.](http://li.nk)"
            ),
            "expect link inside an inline tag" => array(
                new InlineText("$link", InlineTextDelimiter::STRONG),
                "**[some link text](http://li.nk)**"
            ),
            "expect link inside an inline tag to have correct spacing" => array(
                new InlineText("$link_spaced", InlineTextDelimiter::STRONG),
                " **[some link text](http://li.nk)** "
            ),
            "expect heading containing only embed" => array(
                new Heading("$embed"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect heading containing embed with text after" => array(
                new Heading("$embed Hello world!"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n## Hello world!\n"
            ),
            "expect heading containing embed with text before" => array(
                new Heading("Hello world! $embed"),
                "\n\n## Hello world! \n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect heading containing embed with text before and after" => array(
                new Heading("Hello world! $embed It's me again"),
                "\n\n## Hello world! \n\n[#image: /photos/123ID]|||some caption|||\n\n## It's me again\n"
            ),
            "expect inline text conatining only embed" => array(
                new InlineText("$embed", ":"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect inline text conatining embed with text after" => array(
                new InlineText("$embed Hello world!", ":"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n :Hello world!:"
            ),
            "expect inline text conatining embed with text before" => array(
                new InlineText("Hello world! $embed", ":"),
                ":Hello world!: \n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect inline text conatining embed with text before and after" => array(
                new InlineText("Hello world! $embed It's me again", ":"),
                ":Hello world!: \n\n[#image: /photos/123ID]|||some caption|||\n\n :It's me again:"
            ),
            "expect link containing only embed" => array(
                new Link("$embed", "http://li.nk"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing only multiple embeds" => array(
                new Link("{$embed}{$embed}", "http://li.nk"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at start and end" => array(
                new Link("{$embed}some text yo{$embed}", "http://li.nk"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n[some text yo](http://li.nk)\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at end" => array(
                new Link("some text yo $embed", "http://li.nk"),
                "[some text yo](http://li.nk) \n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect link containing text with embed at start" => array(
                new Link("$embed some text yo", "http://li.nk"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            ),
            "expect link containing text with embed" => array(
                new Link("this is $embed some text yo", "http://li.nk"),
                "[this is](http://li.nk) \n\n[#image: /photos/123ID]|||some caption|||\n\n [some text yo](http://li.nk)"
            )
        );
    }
}
