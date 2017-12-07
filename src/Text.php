<?php

namespace CopilotTags;

class Text implements CopilotTag
{
    protected $text;

    public function __construct($text = "")
    {
        $this->text = $text;
    }

    public function write()
    {
        return self::beautify($this->text);
    }

    public static function beautify($markdown)
    {
        // remove whitespace on lines with no non-whitespace characters
        $markdown = preg_replace('/\n\s+\n/', "\n\n", $markdown);
        // replace any more than 2 newlines with 2 newlines
        $markdown = preg_replace('/\n\n\n+/', "\n\n", $markdown);
        return $markdown;
    }
}
