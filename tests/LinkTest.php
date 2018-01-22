<?php
namespace CopilotTags\Tests;
use CopilotTags\Link;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class LinkTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect empty string with no arguments" => array(
                new Link(),
                ""
            ),
            "expect empty string with empty text" => array(
                new Link(""),
                ""
            ),
            "expect text with href" => array(
                new Link("Hello world!", "http://li.nk"),
                "[Hello world!](http://li.nk)"
            ),
            "expect text with href and attribute" => array(
                new Link("Hello world!", "http://li.nk", array("target" => "_blank")),
                "[Hello world!](http://li.nk){: target=\"_blank\" }"
            ),
            "expect text with href and multiple attributes" => array(
                new Link("Hello world!", "http://li.nk", array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](http://li.nk){: target=\"_blank\" title=\"rawr\" }"
            ),
            "expect text with empty href and multiple attributes" => array(
                new Link("Hello world!", "", array("target" => "_blank", "title" => "rawr")),
                "[Hello world!](){: target=\"_blank\" title=\"rawr\" }"
            ),
            "expect trailing whitespace in text to be moved outside of tag" => array(
                new Link("Hello world!\n\n", "http://li.nk"),
                "[Hello world!](http://li.nk)\n\n"
            ),
            "expect leading and trailing whitespace in text to be moved outside of tag" => array(
                new Link("  Hello world!\n\n", "http://li.nk"),
                "  [Hello world!](http://li.nk)\n\n"
            ),
            "expect href with trailing whitespace trimmed" => array(
                new Link("Hello world!", "http://li.nk     "),
                "[Hello world!](http://li.nk)"
            ),
            "expect href with leading whitespace trimmed" => array(
                new Link("Hello world!", "     http://li.nk"),
                "[Hello world!](http://li.nk)"
            ),
            "expect href with leading and trailing whitespace trimmed" => array(
                new Link("Hello world!", "\n\nhttp://li.nk     "),
                "[Hello world!](http://li.nk)"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array(array()),
                '\InvalidArgumentException'
            ),
            "expect null \$href argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$href argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$href argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$href argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", 5),
                '\InvalidArgumentException'
            ),
            "expect array \$href argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", array()),
                '\InvalidArgumentException'
            ),
            "expect \$href argument with internal whitespace to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "http://li .nk"),
                '\InvalidArgumentException'
            ),
            "expect \$href argument with internal newline to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "http://li\n.nk"),
                '\InvalidArgumentException'
            ),
            "expect null \$attributes argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$attributes argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$attributes argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$attributes argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "", 5),
                '\InvalidArgumentException'
            ),
            "expect string \$attributes argument to throw InvalidArgumentException" => array(
                'CopilotTags\Link',
                array("", "", ""),
                '\InvalidArgumentException'
            )
        );
    }
}
