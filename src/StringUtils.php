<?php

namespace CopilotTags;

class StringUtils
{
    static function leadingSpace($text = "") {
        preg_match("/^\s+/", $text, $lwspace);
        return implode("", $lwspace);
    }

    static function trailingSpace($text = "") {
        preg_match("/\s+$/", $text, $rwspace);
        return implode("", $rwspace);
    }
}
