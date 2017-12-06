<?php

namespace CopilotTags;

class Text implements CopilotTag
{
  private $text;

  public function __construct($text = "")
  {
    $this->text = $text;
  }

  public function write()
  {
    return self::beautify($this->text);
  }

  public static function beautify($md)
  {
    // remove whitespace on lines with no non-whitespace characters
    $md = preg_replace('/\n\s+\n/', "\n\n", $md);
    // replace any more than 2 newlines with 2 newlines
    $md = preg_replace('/\n\n\n+/', "\n\n", $md);
    return $md;
  }
}
