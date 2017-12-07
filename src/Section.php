<?php

namespace CopilotTags;

/**
 * Section
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#313-section
 */
class Section extends Text
{
    public function write()
    {
        return self::beautify("$this->text\n-=-=-=-\n");
    }
}
