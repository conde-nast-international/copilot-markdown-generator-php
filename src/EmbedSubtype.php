<?php
namespace CopilotTags;

/**
 * Embed subtypes
 * CFM spec: https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3116-subtypes
 */
abstract class EmbedSubtype
{
    const FACEBOOK = "facebook";
    const GALLERY = "gallery";
    const IFRAME = "iframe";
    const IMAGE = "image";
    const INSTAGRAM = "instagram";
    const TWITTER = "twitter";
    const VIDEO = "video";
}
