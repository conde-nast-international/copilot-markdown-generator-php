<?php
namespace CopilotTags;

/**
 * Inline text
 * CommonMark spec: http://spec.commonmark.org/0.27/#inlines
 * CFM spec (delete): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#314-delete
 * CFM spec (superscript): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#319-superscript
 * CFM spec (subscript): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3110-subscript
 * CFM spec (emphasis): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3111-emphasis
 */
class InlineText extends Text
{
    private $delimiter;

    public function __construct($text, $delimiter = "")
    {
        parent::__construct($text);
        if(!is_string($delimiter)) throw new \InvalidArgumentException(__METHOD__." second argument \$delimiter must be a string. Given: ".($delimiter ? "$delimiter " : "")."(".gettype($delimiter).").");
        $this->delimiter = $delimiter;
    }

    public function write()
    {
        $text = parent::write();
        if($text == "") return "";
        if(trim($text) == "") return $text;

        // Generate each line individually
        if(preg_match("/\n/", $text)) {
            $lines = explode("\n", $text);
            $lines = array_map(function($text) {
                if(preg_match(Embed::EMBED_PATTERN, $text)) return $text;// Don't wrap embeds
                return (new InlineText($text, $this->delimiter))->write();
            }, $lines);
            $text = implode("\n", $lines);
        } else {
            $leftWhitespace = StringUtils::leadingSpace($text);
            $rightWhitespace = StringUtils::trailingSpace($text);
            $text = trim($text);
            $text = "{$leftWhitespace}{$this->delimiter}{$text}{$this->delimiter}{$rightWhitespace}";
        }

        return self::beautify($text);
    }
}
