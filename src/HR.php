<?php

namespace CopilotTags;

/**
 * Thematic Break
 * CommonMark spec: http://spec.commonmark.org/0.28/#thematic-breaks
 */
class HR implements CopilotTag
{
    public function write()
    {
        return "\n----------\n";
    }
}
