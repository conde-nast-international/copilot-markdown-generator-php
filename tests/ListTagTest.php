<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListTag;
use CopilotTags\ListItem;

class ListTagTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect unordered list with single item" => [
                new ListTag(["Hello world!"], FALSE),
                "* Hello world!\n\n"
            ],
            "expect ordered list with single item" => [
                new ListTag(["Hello world!"], TRUE),
                "1. Hello world!\n\n"
            ],
            "expect default unordered list with single item" => [
                new ListTag(["Hello world!"]),
                "* Hello world!\n\n"
            ],
            "expect unordered list with multiple items" => [
                new ListTag(["Hello", "world!"], FALSE),
                "* Hello\n* world!\n\n"
            ],
            "expect ordered list with multiple items" => [
                new ListTag(["Hello", "world!"], TRUE),
                "1. Hello\n2. world!\n\n"
            ],
            "expect default unordered list with multiple items" => [
                new ListTag(["Hello", "world!"]),
                "* Hello\n* world!\n\n"
            ],
            "expect unordered list with single multiline item" => [
                new ListTag(["Hello\nworld!"], FALSE),
                "* Hello\n  world!\n\n"
            ],
            "expect ordered list with single multiline item" => [
                new ListTag(["Hello\nworld!"], TRUE),
                "1. Hello\n   world!\n\n"
            ],
            "expect unordered list with multiple multiline items" => [
                new ListTag(["Hello\nworld!", "Hello\nworld!"], FALSE),
                "* Hello\n  world!\n* Hello\n  world!\n\n"
            ],
            "expect ordered list with multiple multiline items" => [
                new ListTag(["Hello\nworld!", "Hello\nworld!"], TRUE),
                "1. Hello\n   world!\n2. Hello\n   world!\n\n"
            ],
            "expect more than 2 newlines in unordered list item to be reduced to 2" => [
                new ListTag(["Hello\n\n\n\nworld!"], FALSE),
                "* Hello\n  \n  world!\n\n"
            ],
            "expect more than 2 newlines in ordered list item to be reduced to 2" => [
                new ListTag(["Hello\n\n\n\nworld!"], TRUE),
                "1. Hello\n   \n   world!\n\n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null argument to throw InvalidArgumentException" => [
                ListTag::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false argument to throw InvalidArgumentException" => [
                ListTag::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true argument to throw InvalidArgumentException" => [
                ListTag::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number argument to throw InvalidArgumentException" => [
                ListTag::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect string argument to throw InvalidArgumentException" => [
                ListTag::class,
                ["Hello world!"],
                InvalidArgumentException::class
            ],
            "expect array of null argument to throw InvalidArgumentException" => [
                ListTag::class,
                [[NULL, NULL]],
                InvalidArgumentException::class
            ],
            "expect array of boolean false argument to throw InvalidArgumentException" => [
                ListTag::class,
                [[FALSE, FALSE]],
                InvalidArgumentException::class
            ],
            "expect array of boolean true argument to throw InvalidArgumentException" => [
                ListTag::class,
                [[TRUE, TRUE]],
                InvalidArgumentException::class
            ],
            "expect array of number argument to throw InvalidArgumentException" => [
                ListTag::class,
                [[5, 5]],
                InvalidArgumentException::class
            ],
            "expect array of array argument to throw InvalidArgumentException" => [
                ListTag::class,
                [[[], []]],
                InvalidArgumentException::class
            ]
        ];
    }
}
