<?php
namespace CopilotTags;

/**
 * Thematic break
 * CommonMark spec: http://spec.commonmark.org/0.27/#thematic-breaks
 */
class ThematicBreak extends CopilotTag
{
    public function render()
    {
        return "\n----------\n";
    }
}
