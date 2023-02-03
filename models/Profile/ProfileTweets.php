<?php
namespace Titter\Model\Profile;

use Titter\Model\Common\Timeline;

/**
 * Implements a model for the timeline part of the profile.
 * (Tweets, Tweets & replies, Media, NOT Likes) 
 */
class ProfileTweets
{
    public ProfileHeading $heading;

    public Timeline $timeline;

    public function __construct(array $timeline, string $tab, string $screenName)
    {
        $strings = Profile::$strings;

        $this->heading = new ProfileHeading(match ($tab) {
            "" => $strings->tabTweets,
            "with_replies" => $strings->tabWithReplies,
            "media" => $strings->tabMedia
        });

        $this->heading->addTab(new ProfileTab(
            $strings->tabTweets,
            "/{$screenName}",
            "tweets",
            $tab == ""
        ));

        $this->heading->addTab(new ProfileTab(
            $strings->tabWithReplies,
            "/{$screenName}/with_replies",
            "tweets_with_replies",
            $tab == "with_replies"
        ));

        $this->heading->addTab(new ProfileTab(
            $strings->tabMedia,
            "/{$screenName}/media",
            "photos_and_videos",
            $tab == "media"
        ));


    }
}