<?php
namespace CopilotTags;

/**
 * Inline text delimiters
 * CFM spec (emphasis): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#3111-emphasis
 * CommonMark spec (emphasis and strong emphasis): http://spec.commonmark.org/0.27/#emphasis-and-strong-emphasis
 * CFM spec (delete): https://github.com/conde-nast-international/copilot-markdown/blob/master/specification/0E.md#314-delete
 */
abstract class InlineTextDelimiter
{
    const EMPHASIS = "*";
    const STRONG = "**";
    const DELETE = "~~";
}
