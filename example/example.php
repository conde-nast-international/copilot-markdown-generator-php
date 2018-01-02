<?php
require __DIR__ . '/../vendor/autoload.php';
use CopilotTags\Text;
use CopilotTags\Paragraph;
use CopilotTags\Heading;
use CopilotTags\InlineText;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;


const LOG_LEVEL = 2; // 0 = print none, 1 = print normal, 2 = print debug
const FILENAME = 'example_body.xml';


log_message("Reading file contents \"".FILENAME."\"...", 1);
$xml_body = file_get_contents(FILENAME, TRUE);
log_var($xml_body, "\$xml_body", "", 1, FALSE);

log_message("Parsing XML...", 1);
$xml_tag_stack = [];
$markdown_stack = [];
$parser = xml_parser_create();
xml_set_default_handler($parser, 'add_text');
xml_set_element_handler($parser, 'on_open_tag', 'on_close_tag');
try {
    $xml_parse_success = xml_parse($parser, $xml_body, TRUE);
    if(count($markdown_stack) !== 1) $xml_parse_success = 0;
    if (!$xml_parse_success) {
        $error_code = xml_get_error_code($parser);
        $error_string = xml_error_string($error_code);
        $line = xml_get_current_line_number($parser);
        $column = xml_get_current_column_number($parser);
        if (is_string($error_string) && strlen($error_string)) $error_string = ": $error_string";
        throw new Exception("Error ($error_code) parsing XML at $line:$column of \"".FILENAME."\"$error_string.");
    }
    $markdown_body = array_pop($markdown_stack);
    log_message("Success.\n", 1);
    log_var($markdown_body, "\$markdown_body", "", 1, FALSE);
} catch(Exception $e) {
    $message = $e->getMessage();
    log_message($message, 1);
    log_var($markdown_stack, "\$markdown_stack", "", 1, FALSE);
    exit(1);
}
xml_parser_free($parser);

function add_text($parser, $text) {
    global $xml_tag_stack, $markdown_stack;

    log_message("Adding text to current buffer...", 2);
    log_var($text, "\$text", "", 2);
    log_var($markdown_stack, "\$markdown_stack", "BEFORE", 2);

    $stack_index = count($markdown_stack) - 1;
    $markdown_stack[$stack_index] = $markdown_stack[$stack_index].$text;

    log_var($markdown_stack, "\$markdown_stack", "AFTER", 2);
}

function on_open_tag($parser, $name, $attrs) {
    global $xml_tag_stack, $markdown_stack;

    $tagname = strtoupper($name);

    log_message("Open tag \"$tagname\". Putting tag on stack...", 2);
    log_var($xml_tag_stack, "\$xml_tag_stack", "BEFORE", 2);

    array_push($xml_tag_stack, $tagname);
    array_push($markdown_stack, "");

    log_var($xml_tag_stack, "\$xml_tag_stack", "AFTER", 2);
}

function on_close_tag($parser, $name) {
    global $xml_tag_stack, $markdown_stack;

    $tagname = strtoupper($name);

    log_message("Close tag \"$tagname\". Popping stack...", 2);
    log_var($xml_tag_stack, "\$xml_tag_stack", "BEFORE", 2);
    log_var($markdown_stack, "\$markdown_stack", "BEFORE", 2);

    $text = array_pop($markdown_stack);
    $tagname_open = array_pop($xml_tag_stack);

    $line = xml_get_current_line_number($parser);
    $column = xml_get_current_column_number($parser);
    if($tagname !== $tagname_open) throw new Exception("Error parsing XML at $line:$column of \"".FILENAME."\". Open tag \"$tagname_open\" did not have matching close tag. Found close tag \"$tagname\" instead.");

    $tag = NULL;
    switch($tagname) {
        case 'H1':
            $tag = new Heading($text, 1);
            break;
        case 'P':
            $tag = new Paragraph($text);
            break;
        case 'I':
            $tag = new InlineText($text, "*");
            break;
        case 'B':
            $tag = new InlineText($text, "**");
            break;
        case 'STRIKE':
            $tag = new InlineText($text, "~~");
            break;
        case 'EMBED-VIDEO':
            $tag = new Embed($text, EmbedSubtype::VIDEO);
            break;
        default:
            $tag = new Text($text);
    }
    $tag_markdown = $tag->write();

    $stack_index = count($markdown_stack) - 1;
    $markdown_stack[$stack_index] = $markdown_stack[$stack_index].$tag_markdown;

    log_var($xml_tag_stack, "\$xml_tag_stack", "AFTER", 2);
    log_var($markdown_stack, "\$markdown_stack", "AFTER", 2);
}

function log_message($message, $level = 1) {
    if(!LOG_LEVEL || LOG_LEVEL < $level) return;
    print("\n$message\n");
}

function log_var($value, $expr, $prefix = "", $level = 1, $pad = TRUE) {
    if(!LOG_LEVEL || LOG_LEVEL < $level) return;

    if(!isset($value)) $value_str = "UNDEFINED";
    else if(is_array($value)) $value_str = implode("\",\"", $value);
    else $value_str = strval($value);
    $value_str = addcslashes($value_str, "\n\\");

    $lbracket = is_array($value) ? "[" : "";
    $rbracket = is_array($value) ? "]" : "";
    $quote = is_string($value) || (is_array($value) && count($value)) ? "\"" : "";
    $expr_pad = $pad ? str_pad($expr, 16) : $expr;
    $prefix_pad = $pad ? str_pad($prefix, 8)." " : $prefix;
    print("$prefix_pad$expr_pad = $lbracket$quote$value_str$quote$rbracket\n");
}
