<?php
namespace Titter\Model\Traits;

use function Emoji\detect_emoji;

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

    /**
     * Make a runs formatted string from a normal string.
     * 
     * @param string   $text         Original string.
     * @param string[] $displayUrls  List of URLs to display in place of t.co links.
     */
    public static function from(string $text, array $displayUrls = []): object
    {
        $split = preg_split(self::CONTENT_REGEX, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if (count($split) == 1)
        {
            return (object) [
                "simpleText" => $text
            ];
        }
        
        $runs = [];

        // Keep track of the amount of urls added
        $urls = 0;
        foreach ($split as $string)
        {
            switch(substr($string, 0, 1))
            {
                case "@":
                    $runs[] = (object) [
                        "text" => $string,
                        "url" => "/" . substr($string, 1)
                    ];
                    break;
                case "#":
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

        foreach ($runs as $i => &$run)
        if (!isset($run->url) && isset($run->text))
        {
            $twemoji = self::twemoji($run->text);
            if (isset($twemoji->runs))
                array_splice($runs, $i, 1, $twemoji->runs);
        }

        return (object) [
            "runs" => $runs
        ];
    }

    /**
     * Process emojis.
     */
    public static function twemoji(string $text): object
    {
        $emojis = detect_emoji($text);
        if (count($emojis) == 0)
        {
            return (object) [
                "simpleText" => $text
            ];
        }

        $start = 0;
        $runs = [];
        foreach ($emojis as $emoji)
        {
            $beforeText = substr($text, $start, $emoji["byte_offset"] - $start);

            if (!empty($beforeText))
            {
                $runs[] = (object) [
                    "text" => $beforeText
                ];
            }

            // Twemoji URLs omit U+FE0F
            $code = preg_replace("/(^|-)fe0f($|-)/", "", strtolower($emoji["hex_str"]));
            $runs[] = (object) [
                "emoji" => (object) [
                    "url" => "https://twemoji.maxcdn.com/v/latest/72x72/" . $code . ".png",
                    "label" => $emoji["short_name"], // TODO: Use more appropriate text for this
                    "alt" => $emoji["emoji"]
                ]
            ];

            $start = $emoji["byte_offset"] + strlen($emoji["emoji"]);
        }

        $lastText = substr($text, $start, null);
        if (!empty($lastText))
        {
            $runs[] = (object) [
                "text" => $lastText
            ];
        }

        return (object) [
            "runs" => $runs
        ];
    }
}