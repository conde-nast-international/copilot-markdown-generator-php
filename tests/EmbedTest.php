<?php
namespace CopilotTags\Tests;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class EmbedTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect embed with subtype" => array(
                new Embed("https://www.google.com", EmbedSubtype::VIDEO),
                "\n\n[#video: https://www.google.com]\n\n"
            ),
            "expect embed with default subtype" => array(
                new Embed("https://www.google.com"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with http uri converted to https" => array(
                new Embed("http://www.google.com"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect empty string" => array(
                new Embed(""),
                ""
            ),
            "expect embed with caption" => array(
                new Embed("https://www.google.com", EmbedSubtype::IFRAME, "some caption"),
                "\n\n[#iframe: https://www.google.com]|||some caption|||\n\n"
            ),
            "expect image embed with caption and uri beginning with forward slash" => array(
                new Embed("/photos/123ID", EmbedSubtype::IMAGE, "some caption"),
                "\n\n[#image: /photos/123ID]|||some caption|||\n\n"
            ),
            "expect embed with leading whitespace in uri trimmed" => array(
                new Embed(" https://www.google.com"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with trailing whitespace in uri trimmed" => array(
                new Embed("https://www.google.com "),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with leading and trailing whitespace in uri trimmed" => array(
                new Embed(" https://www.google.com "),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with trailing newline in uri trimmed" => array(
                new Embed("https://www.google.com\n"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with leading newline in uri trimmed" => array(
                new Embed("\nhttps://www.google.com"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect embed with leading and trailing newlines in uri trimmed" => array(
                new Embed("\nhttps://www.google.com\n"),
                "\n\n[#iframe: https://www.google.com]\n\n"
            ),
            "expect empty string for only whitespace in uri" => array(
                new Embed("  "),
                ""
            ),
            "expect empty string for only whitespace in uri and trailing newline" => array(
                new Embed("  \n"),
                ""
            ),
            "expect empty string for only whitespace in uri and leading newline" => array(
                new Embed("\n  "),
                ""
            ),
            "expect empty string for only newline in uri" => array(
                new Embed("\n"),
                ""
            ),
            "expect empty string for only multiple newlines in uri" => array(
                new Embed("\n\n\n\n"),
                ""
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$uri argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$uri argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$uri argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$uri argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$uri argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array(array()),
                '\InvalidArgumentException'
            ),
            "expect \$uri argument with internal whitespace to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("http:// www.google.com"),
                '\InvalidArgumentException'
            ),
            "expect \$uri argument with internal newline to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("http://\nwww.google.com"),
                '\InvalidArgumentException'
            ),
            "expect null \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", 5),
                '\InvalidArgumentException'
            ),
            "expect array \$subtype argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", array()),
                '\InvalidArgumentException'
            ),
            "expect null \$caption argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", "", NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$caption argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", "", FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$caption argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", "", TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$caption argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", "", 5),
                '\InvalidArgumentException'
            ),
            "expect array \$caption argument to throw InvalidArgumentException" => array(
                'CopilotTags\Embed',
                array("", "", array()),
                '\InvalidArgumentException'
            )
        );
    }
}
