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
        if ($this->text == "") return self::beautify($this->text);

        $quote = function ($str) { return "> $str\n"; };
        $tag = explode("\n", $this->text);
        $tag = array_map($quote, $tag);
        $tag = implode("", $tag);
        return self::beautify($tag);
    }
}
