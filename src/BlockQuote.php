<?php
namespace CopilotTags;

/**
 * Block quote
 * CommonMark spec: http://spec.commonmark.org/0.27/#block-quotes
 */
class BlockQuote extends Text
{
    public function write()
    {
        if($this->text != "") {
            $write_line = function($str) { return "> $str\n"; };
            $lines = explode("\n", $this->text);
            $lines = array_map($write_line, $lines);
            $blockquote = implode("", $lines);
        } else {
            $blockquote = "\n";
        }
        return self::beautify("\n$blockquote");
    }
}
