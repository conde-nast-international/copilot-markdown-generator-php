<?php
namespace CopilotTags;

/**
 * ATX heading
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#315-heading
 * CommonMark spec: http://spec.commonmark.org/0.27/#atx-headings
 */
class Heading extends Text
{
    const MIN_LEVEL = 2;
    const MAX_LEVEL = 6;

    private $level;

    public function __construct($text, $level = self::MIN_LEVEL)
    {
        parent::__construct($text);

        if(!is_int($level)) throw new \InvalidArgumentException(__METHOD__." second argument \$level must be an int. Given: ".($level ? "$level " : "")."(".gettype($level).").");
        if($level < self::MIN_LEVEL) $this->level = self::MIN_LEVEL;
        else if($level > self::MAX_LEVEL) $this->level = self::MAX_LEVEL;
        else $this->level = $level;
    }

    public function write()
    {
        $text = parent::write();
        if(trim($text) == "") return "";
        $levelString = str_repeat("#", $this->level);
        return self::beautify("$levelString $text\n");
    }
}
