<?php
namespace CopilotTags;

/**
 * Paragraph
 * CommonMark spec: http://spec.commonmark.org/0.27/#paragraphs
 */
class Paragraph extends Text
{
    public function render()
    {
        $text = parent::render();
        $text = "\n\n$text\n\n";
        return self::beautify($text);
    }
}
