<?php
namespace Titter\Controller;

use Titter\RequestMetadata;
use Titter\Network;
use Titter\Model\Error\PageNotFoundError;
use Titter\Model\Profile\Profile;

use function Titter\Async\async;

class ProfileController extends CoreController
{
    public string $template = "profile";

    private const VALID_TABS = [
        "",
        "with_replies",
        "media",
        "likes",
        "followers",
        "following",
        "lists"
    ];

    public function onGet(object &$app, RequestMetadata $request)
    {
        return async(function() use ($app, $request) {
            $data = (object) [];

            $username = $request->path[0];
            if (substr($username, 0, 1) == "@")
            {
                $username = substr($username, 1);
            }
    
            $user = yield Network::graphqlRequest(
                action: "hVhfo_TquFTmgL7gYwf91Q/UserByScreenName",
                variables: [
                    "screen_name" => $request->path[0],
                    "withSafetyModeUserFields" => true,
                    "withSuperFollowsUserFields" => true
                ],
                features: [
                    "responsive_web_twitter_blue_verified_badge_is_enabled" => true,
                    "verified_phone_label_enabled" => false,
                    "responsive_web_graphql_timeline_navigation_enabled" => true,
                    "longform_notetweets_consumption_enabled" => true,
                    "tweetypie_unmention_optimization_enabled" => true,
                    "vibe_api_enabled" => true,
                    "responsive_web_edit_tweet_api_enabled" => true,
                    "graphql_is_translatable_rweb_tweet_is_translatable_enabled" => true,
                    "view_counts_everywhere_api_enabled" => true,
                    "standardized_nudges_misinfo" => true,
                    "tweet_with_visibility_results_prefer_gql_limited_actions_policy_enabled" => false,
                    "interactive_text_enabled" => true,
                    "responsive_web_text_conversations_enabled" => false,
                    "responsive_web_enhance_cards_enabled" => false
                ]
            );
            
            $duser = $user->getJson();

            if ($duser == (object) []) return;
    
            if ($user = @$duser->data->user->result)
            {
                $data->user = $user;
            }
            
            // "Numeric" user ID
            // (it's just a number as a string)
            $uid = $data->user->rest_id;

            $tab = $request->path[1] ?? "";

            if (!in_array($tab, self::VALID_TABS))
            {
                header("Location: /" . $request->path[0]);
            }

            switch ($tab)
            {
                case "":
                case "with_replies":
                case "media":
                    $endpoint = match ($tab)
                    {
                        "" => "sj-BEQ0Jq5AwrydqFstdvg/UserTweets",
                        "with_replies" => "8kng9osBW4CYEw-hlGGHeQ/UserTweetsAndReplies",
                        "media" => "LsL6YcDRR1EWy6Ojp9zeMA/UserMedia",
                        default => null
                    };

                    if (!is_null($endpoint))
                    {
                        $tweets = yield Network::graphqlRequest($endpoint, [
                            "userId" => $uid,
                            "count" => 40,
                            "includePromotedContent" => true,
                            "withQuickPromoteEligibilityTweetFields" => true,
                            "withSuperFollowsUserFields" => true,
                            "withDownvotePerspective" => false,
                            "withReactionsMetadata" => false,
                            "withReactionsPerspective" => false,
                            "withSuperFollowsTweetFields" => true,
                            "withVoice" => true,
                            "withV2Timeline" => true
                        ], [
                            "responsive_web_twitter_blue_verified_badge_is_enabled" => true,
                            "verified_phone_label_enabled" => false,
                            "responsive_web_graphql_timeline_navigation_enabled" => true,
                            "longform_notetweets_consumption_enabled" => true,
                            "tweetypie_unmention_optimization_enabled" => true,
                            "vibe_api_enabled" => true,
                            "responsive_web_edit_tweet_api_enabled" => true,
                            "graphql_is_translatable_rweb_tweet_is_translatable_enabled" => true,
                            "view_counts_everywhere_api_enabled" => true,
                            "standardized_nudges_misinfo" => true,
                            "tweet_with_visibility_results_prefer_gql_limited_actions_policy_enabled" => false,
                            "interactive_text_enabled" => true,
                            "responsive_web_text_conversations_enabled" => false,
                            "responsive_web_enhance_cards_enabled" => false
                        ]);

                        $dtweets = $tweets->getJson();
                        if ($dtweets == (object) []) return;

                        if ($tweets = @$dtweets->data->user->result->timeline_v2->timeline->instructions)
                        {
                            $data->tweets = $tweets;
                        }
                    }
            }
    
            $app->page = new Profile($data, $tab);
        });
    }
}

return new ProfileController();