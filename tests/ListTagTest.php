<?php
namespace CopilotTags\Tests;
use CopilotTags\ListTag;
use CopilotTags\ListItem;

class ListTagTest extends CopilotTagTest
{
    public static function expectedRenders()
    {
        return array(
            "expect unordered list with single item" => array(
                new ListTag(array("Hello world!"), FALSE),
                "\n\n* Hello world!\n\n"
            ),
            "expect ordered list with single item" => array(
                new ListTag(array("Hello world!"), TRUE),
                "\n\n1. Hello world!\n\n"
            ),
            "expect default unordered list with single item" => array(
                new ListTag(array("Hello world!")),
                "\n\n* Hello world!\n\n"
            ),
            "expect unordered list with multiple items" => array(
                new ListTag(array("Hello", "world!"), FALSE),
                "\n\n* Hello\n* world!\n\n"
            ),
            "expect ordered list with multiple items" => array(
                new ListTag(array("Hello", "world!"), TRUE),
                "\n\n1. Hello\n2. world!\n\n"
            ),
            "expect default unordered list with multiple items" => array(
                new ListTag(array("Hello", "world!")),
                "\n\n* Hello\n* world!\n\n"
            ),
            "expect only whitespace" => array(
                new ListTag(array("   ")),
                ""
            ),
            "expect empty string" => array(
                new ListTag(array("")),
                ""
            ),
            "expect unordered list with single multiline item" => array(
                new ListTag(array("Hello\nworld!"), FALSE),
                "\n\n* Hello\n  world!\n\n"
            ),
            "expect ordered list with single multiline item" => array(
                new ListTag(array("Hello\nworld!"), TRUE),
                "\n\n1. Hello\n   world!\n\n"
            ),
            "expect unordered list with multiple multiline items" => array(
                new ListTag(array("Hello\nworld!", "Hello\nworld!"), FALSE),
                "\n\n* Hello\n  world!\n* Hello\n  world!\n\n"
            ),
            "expect ordered list with multiple multiline items" => array(
                new ListTag(array("Hello\nworld!", "Hello\nworld!"), TRUE),
                "\n\n1. Hello\n   world!\n2. Hello\n   world!\n\n"
            ),
            "expect more than 2 newlines in unordered list item to be reduced to 2" => array(
                new ListTag(array("Hello\n\n\n\nworld!"), FALSE),
                "\n\n* Hello\n  \n  world!\n\n"
            ),
            "expect more than 2 newlines in ordered list item to be reduced to 2" => array(
                new ListTag(array("Hello\n\n\n\nworld!"), TRUE),
                "\n\n1. Hello\n   \n   world!\n\n"
            )
        );
    }

    public static function expectedConstructExceptions()
    {
        return array(
            "expect null \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(NULL),
                '\InvalidArgumentException'
            ),
            "expect boolean false \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(FALSE),
                '\InvalidArgumentException'
            ),
            "expect boolean true \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(TRUE),
                '\InvalidArgumentException'
            ),
            "expect number \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(5),
                '\InvalidArgumentException'
            ),
            "expect string \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array("Hello world!"),
                '\InvalidArgumentException'
            ),
            "expect array of null \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(NULL, NULL)),
                '\InvalidArgumentException'
            ),
            "expect array of boolean false \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(FALSE, FALSE)),
                '\InvalidArgumentException'
            ),
            "expect array of boolean true \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(TRUE, TRUE)),
                '\InvalidArgumentException'
            ),
            "expect array of number \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(5, 5)),
                '\InvalidArgumentException'
            ),
            "expect array of array \$items argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(array(), array())),
                '\InvalidArgumentException'
            ),
            "expect null \$ordered argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(), NULL),
                '\InvalidArgumentException'
            ),
            "expect number \$ordered argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(), 5),
                '\InvalidArgumentException'
            ),
            "expect array \$ordered argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(), array()),
                '\InvalidArgumentException'
            ),
            "expect string \$ordered argument to throw InvalidArgumentException" => array(
                'CopilotTags\ListTag',
                array(array(), "Hello world!"),
                '\InvalidArgumentException'
            )
        );
    }
}
