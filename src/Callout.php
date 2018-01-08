<?php
namespace CopilotTags;

/**
 * Callout
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#312-callout
 */
class Callout extends Text
{
    private $subtype;

    public function __construct($text, $subtype = "")
    {
        parent::__construct($text);
        if(!is_string($subtype)) throw new \InvalidArgumentException("Callout::__construct second argument \$subtype must be a string. Given: ".($subtype ? "$subtype " : "")."(".gettype($subtype).").");
        $this->subtype = $subtype;
    }

    public function write()
    {
        $tag = $this->text;
        if(trim($tag) !== "") $tag = "+++$this->subtype\n$tag\n+++";
        if($tag !== "") $tag = "$tag\n";
        return self::beautify($tag);
    }
}
