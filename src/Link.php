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
        $this->href = $href;
        $this->attributes = $attributes;
    }

    public function write()
    {
        if ($this->text == "") return self::beautify($this->text);

        // Generate each line individually
        if (preg_match("/\n/", $this->text)) {
            $tags = explode("\n", $this->text);
            $tags = array_map(function($tag) {
              if (preg_match(Embed::EMBED_PATTERN, $tag)) return $tag;// Don't wrap embeds
              if (!trim($tag)) return $tag;
              return (new Link($tag, $this->href, $this->attributes))->write();
            }, $tags);
            $tags = implode("\n", $tags);
            return self::beautify($tags);
        }

        $text = $this->text;

        $lwspace = StringUtils::leadingSpace($text);
        $rwspace = StringUtils::trailingSpace($text);

        $text = trim($text);
        $href = trim($this->href);
        $href = preg_replace("/\n/", "", $href);

        $attrs = "";
        if ($this->attributes) {
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
