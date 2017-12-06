<?php

namespace CopilotTags;

class Embed implements CopilotTag
{
  const EMBED_PATTERN = '/!?\[#(\w+):\s*(\S+?)((?:\s?(?:\w+:\s?\w+))*?)\](?:\(((?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)(?:x?(?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)*))\))*(?:\|{3}([\S\s]*?)\|{3})*/';

  private $uri;
  private $subtype;
  private $caption;

  public function __construct($uri, $subtype = EmbedSubtype::IFRAME, $caption = "")
  {
    $this->uri = self::convertHttpToHttps(trim($uri));
    $this->subtype = $subtype;
    $this->caption = $caption;
  }

  public function write()
  {
    if ($this->uri === "") return "";
    $caption = $this->caption !== "" ? "|||$this->caption|||" : "";
    return "\n\n[#$this->subtype:$this->uri]$caption\n";
  }

  private static function convertHttpToHttps($uri)
  {
    return preg_replace('/^http:/i', 'https:', $uri);
  }
}
