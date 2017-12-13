<?php
namespace CopilotTags;

function getOuterSpace($text = "") {
    preg_match("/^\s+/", $text, $lwspace);
    $lwspace = implode("", $lwspace);

    preg_match("/\s+$/", $text, $rwspace);
    $rwspace = implode("", $rwspace);

    return ["lwspace" => $lwspace, "rwspace" => $rwspace];
}

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
        if (preg_match("/\n/", $this->text)) {
            $tags = explode("\n", $this->text);
            $tags = array_map(function($tag) {
              $blockRegex = "/\[#\w+:\s*\S+?(?:\s?(?:\w+:\s?\w+)*?)\](?:\((?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)(?:x?(?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)*)\))*(?:\|{3}[\S\s]*?\|{3})*/";
              if (preg_match($blockRegex, $tag)) return $tag;
              if (!trim($tag)) return $tag;
              return (new Link($tag, $this->href, $this->attributes))->write();
            }, $tags);
            return implode("\n", $tags);
        }

        $text = $this->text;

        $space = getOuterSpace($text);
        $rwspace = $space["rwspace"];
        $lwspace = $space["lwspace"];

        $text = trim($text);
        $href = trim($this->href);

        $attrs = "";
        if ($this->attributes) {
            foreach($this->attributes as $key => $value) {
                $attrs = "$attrs $key=\"$value\"";
            }
            $attrs = "{:$attrs }";
        }
        return "{$lwspace}[$text]($href){$attrs}{$rwspace}";
    }
}
