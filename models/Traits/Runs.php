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
    public const CONTENT_REGEX =
    "/" .
    "((?<=^|\s)@[a-zA-Z0-9_]{1,20}\b)". // Mentions
    "|" .
    "((?<=^|\s)#[a-zA-Z0-9_]+\b)" . // Hashtags
    "|" .
    "((?:http|https):\/\/t\.co\/[a-zA-Z0-9\-\.]{8,10})" .
    "/i";

    public const MENTION_CHARACTER = "@";
    public const HASHTAG_CHARACTER = "#";

    public const EMOJI_REGEX = "/(\u00a9|\u00ae|[\u2000-\u3300]|\ud83c[\ud000-\udfff]|\ud83d[\ud000-\udfff]|\ud83e[\ud000-\udfff])/";

    /**
     * Make a runs formatted string from a normal string.
     * 
     * @param string   $orig         Original string.
     * @param string[] $displayUrls  List of URLs to display in place of t.co links.
     */
    public static function from(string $orig, array $displayUrls = []): object
    {
        $split = preg_split(self::CONTENT_REGEX, $orig, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if (count($split) == 1)
        {
            return (object) [
                "simpleText" => $orig
            ];
        }
        
        $runs = [];

        // Keep track of the amount of urls added
        $urls = 0;
        foreach ($split as $string)
        {
            switch(substr($string, 0, 1))
            {
                case self::MENTION_CHARACTER:
                    $runs[] = (object) [
                        "text" => $string,
                        "url" => "/" . substr($string, 1)
                    ];
                    break;
                case self::HASHTAG_CHARACTER:
                    $runs[] = (object) [
                        "text" => $string,
                        "url" => "/hashtag/" . substr($string, 1)
                    ];
                    break;
                default:
                    if (substr($string, 0, 4) == "http")
                    {
                        $runs[] = (object) [
                            "text" => $displayUrls[$urls] ?? $string,
                            "url" => $string
                        ];
                        $urls++;
                    }
                    else
                    {
                        $runs[] = (object) [
                            "text" => $string
                        ];
                    }
            }
        }

        return (object) [
            "runs" => $runs
        ];
    }
}