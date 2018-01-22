<?php
namespace CopilotTags;

/**
 * Block quote
 * CommonMark spec: http://spec.commonmark.org/0.27/#block-quotes
 */
class Blockquote extends Text
{
    public function render()
    {
        if ($this->text != "") {
            $lines = explode("\n", $this->text);
            $lines = array_map(
                function($str) {
                    return "> $str\n";
                },
                $lines
            );
            $blockquote = implode("", $lines);
        } else {
            $blockquote = "\n";
        }
        return self::beautify("\n$blockquote");
    }
}
