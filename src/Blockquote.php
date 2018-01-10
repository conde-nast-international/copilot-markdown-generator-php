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
        // we use the unbeautified text property instead of
        // parent::write() to allow quoted whitespace
        $text = $this->text;
        if($text == "") return "";

        $lines = explode("\n", $text);
        $lines = array_map(function($str) {
            return "> $str\n";
        }, $lines);

        $text = implode("", $lines);
        // put embeds on their own line
        $text = preg_replace(Embed::EMBED_PATTERN, "\n\n$0\n", $text);
        return self::beautify($text);
    }

    public static function beautify($markdown)
    {
        // remove whitespace-only lines at the end of block quotes
        // (e.g. created during handling of nested embeds)
        $markdown = preg_replace('/(>[^\S\n]*\n)+$/', "", $markdown);
        $markdown = preg_replace('/(>[^\S\n]*\n)+([^>])/', "\n$2", $markdown);
        // remove whitespace-only lines at the start of block quotes
        $markdown = preg_replace('/^([^>].*\n)*(>[^\S\n]*\n)+/', "$1", $markdown);
        $markdown = preg_replace('/\n([^>].*\n)+(>[^\S\n]*\n)+/', "$1", $markdown);
        return parent::beautify($markdown);
    }
}
