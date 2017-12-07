<?php

namespace CopilotTags;

/**
 * Thematic break
 * CommonMark spec: http://spec.commonmark.org/0.27/#thematic-breaks
 */
class HR implements CopilotTag
{
    public function write()
    {
        return "\n----------\n";
    }
}
