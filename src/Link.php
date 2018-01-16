<?php
namespace CopilotTags;

/**
 * Link
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#317-link
 * CommonMark spec: http://spec.commonmark.org/0.27/#links
 */
class Link extends Text
{
    public function __construct($text = "", $href = "", $attributes = array())
    {
        parent::__construct($text);

        if(!is_string($href)) throw new \InvalidArgumentException(__METHOD__." second argument \$href must be a string. Given: ".($href ? "$href " : "")."(".gettype($href).").");
        $href = trim($href);
        if(preg_match('/\s/', $href)) throw new \InvalidArgumentException(__METHOD__." second argument \$href must not contain whitespace. Given: \"".str_replace("\n", "\\n", $href)."\".");
        $this->href = $href;

        if(!is_array($attributes)) throw new \InvalidArgumentException(__METHOD__." third argument \$attributes must be an array. Given: ".($attributes ? "$attributes " : "")."(".gettype($attributes).").");
        $this->attributes = $attributes;
    }

    public function render()
    {
        if($this->text == "") return self::beautify($this->text);
        $text = $this->text;
        $href = $this->href;
        $attributes = $this->attributes;

        // Generate each line individually
        if(preg_match("/\n/", $text)) {
            $tags = explode("\n", $text);
            $tags = array_map(function($tag) use ($href, $attributes) {
              if(preg_match(Embed::EMBED_PATTERN, $tag)) return $tag;// Don't wrap embeds
              if(!trim($tag)) return $tag;
              $tag = new Link($tag, $href, $attributes);
              return $tag->render();
            }, $tags);
            $tags = implode("\n", $tags);
            return self::beautify($tags);
        }

        $lwspace = StringUtils::leadingSpace($text);
        $rwspace = StringUtils::trailingSpace($text);

        $text = trim($text);
        $href = preg_replace("/\n/", "", $href);

        $attrs = "";
        if($attributes) {
            foreach($attributes as $key => $value) {
                $attrs = "$attrs $key=\"$value\"";
            }
            $attrs = "{:$attrs }";
        }
        return self::beautify("{$lwspace}[$text]($href){$attrs}{$rwspace}");
    }

    public static function beautify($markdown) {
        // convert multiple links with whitespace between them to a single link
        $markdown = preg_replace("/\]\(.*\)\s*\[([^#])/", " $1", $markdown);
        return parent::beautify($markdown);
    }
}
