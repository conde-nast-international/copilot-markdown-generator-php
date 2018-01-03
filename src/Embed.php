<?php
namespace CopilotTags;

/**
 * Embed
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#311-embed
 */
class Embed implements CopilotTag
{
    const EMBED_PATTERN = '/!?\[#(\w+):\s*(\S+?)((?:\s?(?:\w+:\s?\w+))*?)\](?:\(((?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)(?:x?(?:\d+(?:%|em|ex|px|pt|pc|cm|mm|in)?)*))\))*(?:\|{3}([\S\s]*?)\|{3})*/';

    private $uri;
    private $subtype;
    private $caption;

    public function __construct($uri, $subtype = EmbedSubtype::IFRAME, $caption = "")
    {
        if (!is_string($uri)) throw new \InvalidArgumentException("Embed::__construct first argument \$uri must be a string. Given: ".($uri ? "$uri " : "")."(".gettype($uri).").");
        $uri = trim($uri);
        if (preg_match('/\s/', $uri)) throw new \InvalidArgumentException("Embed::__construct first argument \$uri cannot contain whitespace. Given: \"".str_replace("\n", "\\n", $uri)."\".");
        $this->uri = self::convertHttpToHttps($uri);

        if (!is_string($subtype)) throw new \InvalidArgumentException("Embed::__construct second argument \$subtype must be a string. Given: ".($subtype ? "$subtype " : "")."(".gettype($subtype).").");
        $this->subtype = $subtype;
        if (!is_string($caption)) throw new \InvalidArgumentException("Embed::__construct third argument \$caption must be a string. Given: ".($caption ? "$caption " : "")."(".gettype($caption).").");
        $this->caption = $caption;
    }

    public function write()
    {
        if ($this->uri === "") return "";
        $caption = $this->caption !== "" ? "|||$this->caption|||" : "";
        return "\n\n[#$this->subtype:$this->uri]$caption\n";
    }

    private static function convertHttpToHttps($url)
    {
        return preg_replace('/^http:/i', 'https:', $url);
    }
}
