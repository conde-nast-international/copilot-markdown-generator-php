<?php
namespace CopilotTags;

abstract class CopilotTag
{
    // NOTE: using toString will result in a fatal error for thrown exceptions
    // https://secure.php.net/manual/en/language.oop5.magic.php#object.tostring
    public function __toString()
    {
        return $this->render();
    }

    public abstract function render();
}
