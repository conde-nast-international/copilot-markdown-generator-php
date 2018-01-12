<?php
namespace CopilotTags;

class StringUtils
{
    static function leadingSpace($str) {
        preg_match("/^\s*/", $str, $lwspace);
        return $lwspace[0];
    }

    static function trailingSpace($str) {
        preg_match("/\s*$/", $str, $rwspace);
        return $rwspace[0];
    }
}
