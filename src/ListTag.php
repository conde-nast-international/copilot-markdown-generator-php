<?php
namespace CopilotTags;

/**
 * List
 * CommonMark spec: http://spec.commonmark.org/0.27/#lists
 */
class ListTag implements CopilotTag
{
    private $items;
    private $ordered;

    public function __construct($items, $ordered = FALSE)
    {
        if (!is_array($items)) throw new \InvalidArgumentException("ListTag::__construct first argument \$items must be an array. Given: ".($items ? "$items " : "")."(".gettype($items).").");
        $this->items = $items;
        $this->ordered = $ordered;
    }

    public function write()
    {
        // TODO
        return implode("\n", $this->items);
    }
}
