<?php
namespace CopilotTags;

/**
 * Section
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#313-section
 */
class Section implements CopilotTag
{
    public function render()
    {
        return "\n-=-=-=-\n";
    }
}
