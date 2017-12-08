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

    public function __construct($items = [], $ordered = false)
    {
        $this->items = $items;
        $this->ordered = $ordered;
    }

    public function write()
    {
        // TODO
        return implode("\n", $this->items);
    }
}
