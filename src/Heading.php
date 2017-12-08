<?php
namespace CopilotTags;

/**
 * ATX heading
 * CommonMark spec: http://spec.commonmark.org/0.27/#atx-headings
 */
class Heading extends Text
{
    const MIN_LEVEL = 2;
    const MAX_LEVEL = 6;

    private $level;

    public function __construct($text = "", $level = self::MIN_LEVEL)
    {
        parent::__construct($text);

        if ($level < self::MIN_LEVEL) $this->level = self::MIN_LEVEL;
        else if ($level > self::MAX_LEVEL) $this->level = self::MAX_LEVEL;
        else $this->level = $level;
    }

    public function write()
    {
        $tag = $this->text;
        if (trim($tag) !== "") {
            $levelString = str_repeat("#", $this->level);
            $tag = "$levelString $tag";
        }
        if ($tag !== "") $tag = "$tag\n";
        return self::beautify($tag);
    }
}
