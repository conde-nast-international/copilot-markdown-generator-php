<?php
namespace CopilotTags;

class Text implements CopilotTag
{
    protected $text;

    public function __construct($text)
    {
        if (!is_string($text)) throw new \InvalidArgumentException(__METHOD__." first argument \$text must be a string. Given: ".($text ? "$text " : "")."(".gettype($text).").");
        // convert newline types to LF newlines
        $text = preg_replace('/\R/', "\n", $text);
        $this->text = $text;
    }

    public function render()
    {
        return self::beautify($this->text);
    }

    public static function beautify($markdown)
    {
        // remove whitespace on lines with no non-whitespace characters
        $markdown = preg_replace('/\n\s+\n/', "\n\n", $markdown);
        $markdown = preg_replace('/^[^\S\n]+\n/', "\n", $markdown);
        $markdown = preg_replace('/\n[^\S\n]+$/', "\n", $markdown);
        // replace any more than 2 newlines with 2 newlines
        $markdown = preg_replace('/\n\n\n+/', "\n\n", $markdown);
        return $markdown;
    }
}
