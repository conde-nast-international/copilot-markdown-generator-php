<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Section;

class SectionTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            "expect section" => [
                new Section(),
                "\n-=-=-=-\n"
            ]
        ];
    }

    public function expectedConstructExceptions()
    {
        return [
            "expect null \$text argument to throw InvalidArgumentException" => [
                Section::class,
                [NULL],
                InvalidArgumentException::class
            ],
            "expect boolean false \$text argument to throw InvalidArgumentException" => [
                Section::class,
                [FALSE],
                InvalidArgumentException::class
            ],
            "expect boolean true \$text argument to throw InvalidArgumentException" => [
                Section::class,
                [TRUE],
                InvalidArgumentException::class
            ],
            "expect number \$text argument to throw InvalidArgumentException" => [
                Section::class,
                [5],
                InvalidArgumentException::class
            ],
            "expect array \$text argument to throw InvalidArgumentException" => [
                Section::class,
                [[]],
                InvalidArgumentException::class
            ]
        ];
    }
}
