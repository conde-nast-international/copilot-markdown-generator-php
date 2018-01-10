<?php
namespace CopilotTags;
use CopilotTags\Text;

/**
 * List
 * CommonMark spec: http://spec.commonmark.org/0.27/#lists
 */
class ListTag implements CopilotTag
{
    const LIST_MARKER_BULLET = "*";
    const LIST_MARKER_ORDERED = ".";

    private $items;
    private $ordered;

    public function __construct($items, $ordered = FALSE)
    {
        if(!is_array($items)) throw new \InvalidArgumentException(__METHOD__." first argument \$items must be an array. Given: ".($items ? "$items " : "")."(".gettype($items).").");
        foreach($items as $i => $item) {
            if(!is_string($item)) throw new \InvalidArgumentException(__METHOD__." first argument \$items must be an array of strings. Given \$items[$i] = ".($item ? "$item " : "")."(".(gettype($item)).").");
        }
        $this->items = $items;
        if(!is_bool($ordered)) throw new \InvalidArgumentException(__METHOD__." second argument \$ordered must be a bool. Given: ".($ordered ? "$ordered " : "")."(".gettype($ordered).").");
        $this->ordered = $ordered;
    }

    public function write()
    {
        $item_indentation = $this->ordered ? "   " : "  ";

        $list = "";
        foreach($this->items as $i => $item) {
            $text = new Text($item);
            $item = $text->write();
            $item = trim($item);
            if($item == "") continue;

            // indent multiline content
            $item = preg_replace('/\n/', "\n$item_indentation", $item);
            // prefix with list marker
            if($this->ordered) $list_marker = strval($i + 1).self::LIST_MARKER_ORDERED;
            else $list_marker = self::LIST_MARKER_BULLET;
            $list = "$list$list_marker $item\n";
        }
        if($list != "") $list = "\n\n$list\n";
        return $list;
    }
}
