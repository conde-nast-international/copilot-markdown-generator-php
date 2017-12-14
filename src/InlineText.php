<?php
namespace CopilotTags;

/**
 * Inline text
 * CommonMark spec: http://spec.commonmark.org/0.27/#inlines
 */
class InlineText extends Text
{

    private $mdTag;

    public function __construct($text, $markdownTag = "")
    {
        parent::__construct($text);
        $this->mdTag = $markdownTag;
    }

    public function write()
    {
        $tag = parent::write($this->text);
        if (!trim($tag)) return $tag;
        $tag = preg_replace(Embed::EMBED_PATTERN, "\n$0\n", $tag);

        if (preg_match("/\n/", $tag)) {
          $tag = explode("\n", $tag);
          $tag = array_map(function ($splitTag) {
            if (preg_match(Embed::EMBED_PATTERN, $splitTag)) return $splitTag;
            return (new InlineText($splitTag, $this->mdTag))->write();
          }, $tag);
          $tag = implode("\n", $tag);
        } else {
          $leftWhitespace = StringUtils::leadingSpace($tag);
          $rightWhitespace = StringUtils::trailingSpace($tag);
          $tag = trim($tag);
          $tag = "{$leftWhitespace}{$this->mdTag}{$tag}{$this->mdTag}{$rightWhitespace}";
        }

        return self::beautify($tag);
    }
}
