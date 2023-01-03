<?php
namespace Titter\Model\Traits;

/**
 * Implements a way to put links inside of text.
 * Twitter's internal API just gives the raw text,
 * so we have to format it for the frontend ourselves.
 * This format is heavily borrowed from InnerTube (YouTube's internal API).
 * 
 * A simple string would be:
 * {
 *    "simpleText": "Simple string"
 * }
 * 
 * A string with links would be:
 * {
 *    "runs": [
 *       {
 *          "text": "Hello, "
 *       },
 *       {
 *          "text": "@world",
 *          "url": "/world"
 *       },
 *       {
 *          "text": "!"
 *       }
 *    ]
 * }
 */
class Runs
{
    public const MENTION_REGEX = "/(?<=^|\s)@[a-zA-Z0-9_]{1,20}\b/i";
    public const HASHTAG_REGEX = "/(?<=^|\s)#[a-zA-Z0-9_]+\b/i";

    public static function from(string $orig): object
    {
        $mentions = [];
        preg_match_all(self::MENTION_REGEX, $orig, $mentions);

        $hashtags = [];
        preg_match_all(self::HASHTAG_REGEX, $orig, $hashtags);
    }
}