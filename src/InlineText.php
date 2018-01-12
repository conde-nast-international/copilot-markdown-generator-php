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

    public function render()
    {
        $tag = $this->text;
        if(!trim($tag)) return $tag;

        // Put embeds on their own lines
        $tag = preg_replace(Embed::EMBED_PATTERN, "\n$0\n", $tag);

        // Generate each line individually
        if(preg_match("/\n/", $tag)) {
          $tag = explode("\n", $tag);
          $tag = array_map(function($splitTag) {
            if(preg_match(Embed::EMBED_PATTERN, $splitTag)) return $splitTag;// Don't wrap embeds
            return (new InlineText($splitTag, $this->delimiter))->render();
          }, $tag);
          $tag = implode("\n", $tag);
        } else {
          // Maintain surrounding space
          $leftWhitespace = StringUtils::leadingSpace($tag);
          $rightWhitespace = StringUtils::trailingSpace($tag);
          $tag = trim($tag);
          $tag = "{$leftWhitespace}{$this->delimiter}{$tag}{$this->delimiter}{$rightWhitespace}";
        }

        return self::beautify($tag);
    }
}
