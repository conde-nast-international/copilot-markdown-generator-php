<?php
namespace CopilotTags;

/**
 * Link
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#317-link
 * CommonMark spec: http://spec.commonmark.org/0.27/#links
 */
class Link extends Text
{
    public function __construct($text = "", $href = "", $attributes = [])
    {
        parent::__construct($text);

        if(!is_string($href)) throw new \InvalidArgumentException(__METHOD__." second argument \$href must be a string. Given: ".($href ? "$href " : "")."(".gettype($href).").");
        $href = trim($href);
        if(preg_match('/\s/', $href)) throw new \InvalidArgumentException(__METHOD__." second argument \$href must not contain whitespace. Given: \"".str_replace("\n", "\\n", $href)."\".");
        $this->href = $href;

        if(!is_array($attributes)) throw new \InvalidArgumentException(__METHOD__." third argument \$attributes must be an array. Given: ".($attributes ? "$attributes " : "")."(".gettype($attributes).").");
        $this->attributes = $attributes;
    }

    public function write()
    {
        $text = parent::write();
        if($text == "") return "";

        // Generate each line individually
        if(preg_match("/\n/", $text)) {
            $lines = explode("\n", $text);
            $lines = array_map(function($text) {
                if(preg_match(Embed::EMBED_PATTERN, $text)) return $text;// Don't wrap embeds
                return (new Link($text, $this->href, $this->attributes))->write();
            }, $lines);
            $text = implode("\n", $lines);
            return self::beautify($text);
        }

        if(trim($text) != "") {
            $lwspace = StringUtils::leadingSpace($text);
            $rwspace = StringUtils::trailingSpace($text);
            $text = trim($text);
        } else {
            $lwspace = "";
            $rwspace = "";
        }

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

    public static function beautify($markdown) {
        // convert multiple links with whitespace between them to a single link
        $markdown = preg_replace("/\]\(.*\)\s*\[([^#])/", " $1", $markdown);
        return parent::beautify($markdown);
    }
}
