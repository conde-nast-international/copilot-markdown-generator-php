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

        if (!is_int($level)) throw new \InvalidArgumentException(__METHOD__." second argument \$level must be an int. Given: ".($level ? "$level " : "")."(".gettype($level).").");
        if ($level < self::MIN_LEVEL) $this->level = self::MIN_LEVEL;
        else if ($level > self::MAX_LEVEL) $this->level = self::MAX_LEVEL;
        else $this->level = $level;
    }

    public function render()
    {
        $text = parent::render();
        $level = $this->level;

        // put embed blocks on their own line
        $text = preg_replace(Embed::EMBED_PATTERN, "\n$0\n", $text);

        // generate each line individually
        if (preg_match("/\n/", $text)) {
            $lines = explode("\n", $text);
            $lines = array_map(
                function($text) use ($level) {
                    if (preg_match(Embed::EMBED_PATTERN, $text)) return $text;
                    $text = new Heading($text, $level);
                    return $text->render();
                },
                $lines
            );
            $text = implode("\n", $lines);
        } else {
            if (trim($text) != "") {
                $levelString = str_repeat("#", $level);
                $leadingWhitespace = StringUtils::leadingSpace($text);
                $trailingWhitespace = StringUtils::trailingSpace($text);
                $text = trim($text);
                $text = "$leadingWhitespace\n$levelString $text$trailingWhitespace";
            }
            $text = "\n\n$text\n";
        }
        return self::beautify($text);
    }
}
