<?php

namespace CopilotTags;

class Text implements Tag
{
  private $text = "";

  public function __construct($text)
  {
    $this->text = $text;
  }

  public function write()
  {
    return $this->text;
  }
}
