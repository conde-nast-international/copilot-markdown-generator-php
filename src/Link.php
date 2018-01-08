<?php
namespace CopilotTags;

/**
 * Link
 * CommonMark spec: http://spec.commonmark.org/0.27/#links
 */
class Link extends Text
{
    public function __construct($text = "", $href = "", $attributes = [])
    {
        parent::__construct($text);

        if(!is_string($href)) throw new \InvalidArgumentException("Link::__construct second argument \$href must be a string. Given: ".($href ? "$href " : "")."(".gettype($href).").");
        $href = trim($href);
        if(preg_match('/\s/', $href)) throw new \InvalidArgumentException("Link::__construct second argument \$href must not contain whitespace. Given: \"".str_replace("\n", "\\n", $href)."\".");
        $this->href = $href;

        if(!is_array($attributes)) throw new \InvalidArgumentException("Link::__construct third argument \$attributes must be an array. Given: ".($attributes ? "$attributes " : "")."(".gettype($attributes).").");
        $this->attributes = $attributes;
    }

    public function write()
    {
        if($this->text == "") return self::beautify($this->text);

        // Generate each line individually
        if(preg_match("/\n/", $this->text)) {
            $tags = explode("\n", $this->text);
            $tags = array_map(function($tag) {
              if(preg_match(Embed::EMBED_PATTERN, $tag)) return $tag;// Don't wrap embeds
              if(!trim($tag)) return $tag;
              return (new Link($tag, $this->href, $this->attributes))->write();
            }, $tags);
            $tags = implode("\n", $tags);
            return self::beautify($tags);
        }

        $text = $this->text;

        $lwspace = StringUtils::leadingSpace($text);
        $rwspace = StringUtils::trailingSpace($text);

        $text = trim($text);
        $href = preg_replace("/\n/", "", $this->href);

        $attrs = "";
        if($this->attributes) {
            foreach($this->attributes as $key => $value) {
                $attrs = "$attrs $key=\"$value\"";
            }
            $attrs = "{:$attrs }";
        }
        return self::beautify("{$lwspace}[$text]($href){$attrs}{$rwspace}");
    }

    static function beautify($md = "") {
        $md = preg_replace("/\]\(.*\)\s*\[([^#])/", " $1", $md);
        return parent::beautify($md);
    }
}
