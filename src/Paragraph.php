<?php
namespace CopilotTags;

/**
 * Paragraph
 * CommonMark spec: http://spec.commonmark.org/0.27/#paragraphs
 */
class Paragraph extends Text
{
    public function write()
    {
        $text = parent::write();
        $text = "\n$text\n\n";
        return self::beautify($text);
    }
}
