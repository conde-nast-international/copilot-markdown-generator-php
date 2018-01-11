<?php
namespace CopilotTags;

/**
 * Blockquote
 * CommonMark spec: http://spec.commonmark.org/0.27/#block-quotes
 */
class Blockquote extends Text
{
    public function write()
    {
        if($this->text == "") return "";

        $write_line = function($str) { return "> $str\n"; };
        $lines = explode("\n", $this->text);
        $lines = array_map($write_line, $lines);

        $blockquote = implode("", $lines);
        return self::beautify("\n$blockquote");
    }
}
