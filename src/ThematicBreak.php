<?php
namespace CopilotTags;

/**
 * Thematic break
 * CommonMark spec: http://spec.commonmark.org/0.27/#thematic-breaks
 */
class ThematicBreak implements CopilotTag
{
    public function write()
    {
        return "\n----------\n";
    }
}
