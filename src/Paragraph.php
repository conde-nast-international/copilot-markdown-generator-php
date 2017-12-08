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
        $tag = $this->text;
        if ($tag !== "") $tag = "$tag\n\n";
        return self::beautify($tag);
    }
}
