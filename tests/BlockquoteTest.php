<?php
namespace CopilotTags\Tests;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return  array(
            "expect single text line" => array(
                new Blockquote("Hello world!"),
                "\n> Hello world!\n"
            ),
            "expect multiple text lines" => array(
                new Blockquote("The city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!"),
                "\n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n"
            ),
            "expect multiple lines with leading and trailing whitespace preserved" => array(
                new Blockquote("\n\nThe city’s central computer told you?\nR2D2,\nyou know better than to trust a strange computer!\n"),
                "\n> \n> \n> The city’s central computer told you?\n> R2D2,\n> you know better than to trust a strange computer!\n> \n"
            ),
            "expect whitespace to be preserved" => array(
                new Blockquote("  "),
                "\n>   \n"
            ),
            "expect empty string" => array(
                new Blockquote(""),
                "\n\n"
            ),
            "expect newline to be preserved with spaces before" => array(
                new Blockquote("  \n"),
                "\n>   \n> \n"
            ),
            "expect newline to be preserved with spaces after" => array(
                new Blockquote("\n  "),
                "\n> \n>   \n"
            ),
            "expect a single newline to be preserved" => array(
                new Blockquote("\n"),
                "\n> \n> \n"
            ),
            "expect multiple newlines to be preserved" => array(
                new Blockquote("\n\n\n\n"),
                "\n> \n> \n> \n> \n> \n"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Blockquote',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Blockquote',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Blockquote',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Blockquote',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect array \$text argument to throw InvalidArgumentException" => array(
                'CopilotTags\Blockquote',
                array(array()),
                '\InvalidArgumentException'
            )
        );
    }
}
