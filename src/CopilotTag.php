<?php
namespace CopilotTags;


// TODO: Put these somewhere sensible
const blockRegex = "/\[#\w+:\s*\S+?(?:\s?(?:\w+:\s?\w+)*?)\](?:\((?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)(?:x?(?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)*)\))*(?:\|{3}[\S\s]*?\|{3})*/";

function getOuterSpace($text = "") {
    preg_match("/^\s+/", $text, $lwspace);
    $lwspace = implode("", $lwspace);

    preg_match("/\s+$/", $text, $rwspace);
    $rwspace = implode("", $rwspace);

    return ["lwspace" => $lwspace, "rwspace" => $rwspace];
}

interface CopilotTag
{
    public function write();
}
