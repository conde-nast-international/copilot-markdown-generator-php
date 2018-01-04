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
        if (!is_array($items)) throw new \InvalidArgumentException("ListTag::__construct first argument \$items must be an array. Given: ".($items ? "$items " : "")."(".gettype($items).").");
        foreach($items as $i=>$item) {
            if (!is_string($item)) throw new \InvalidArgumentException("ListTag::__construct first argument \$items must be an array of strings. Given \$items[$i] = ".($item ? "$item " : "")."(".(gettype($item)).").");
        }
        $this->items = $items;
        $this->ordered = $ordered;
    }

    public function write()
    {
        $item_indentation = $this->ordered ? "   " : "  ";

        $tag = "";
        foreach($this->items as $i=>$item) {
            $text = new Text($item);
            $item = $text->write();
            $item = trim($item);
            // indent multiline content
            $item = preg_replace('/\n/', "\n$item_indentation", $item);
            // prefix with list marker
            if($this->ordered) {
                $item = strval($i + 1).self::LIST_MARKER_ORDERED." $item";
            } else {
                $item = self::LIST_MARKER_BULLET." $item";
            }
            $tag = "$tag$item\n";
        }
        $tag = "$tag\n";
        return $tag;
    }
}
