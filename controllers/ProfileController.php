<?php
namespace Titter\Controller;

use Titter\{
    ControllerV2\RequestMetadata,
    Controller\Core\CoreController,
    Network,
    Model\Error\PageNotFoundError,
    Model\Profile\Profile
};

use function Titter\Async\async;

class ProfileController extends CoreController
{
    public string $template = "profile";

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
                action: "UserByScreenName",
                variables: [
                    "screen_name" => $request->path[0],
                    "withSafetyModeUserFields" => true,
                    "withSuperFollowsUserFields" => true
                ],
                features: [
                    "responsive_web_twitter_blue_verified_badge_is_enabled" => true,
                    "verified_phone_label_enabled" => false,
                    "responsive_web_twitter_blue_new_verification_copy_is_enabled" => true,
                    "responsive_web_graphql_timeline_navigation_enabled" => true
                ]
            );
            
            $decoded = $user->getJson();

            if ($decoded == (object) [])
            {
                return;
            }
    
            if ($user = @$decoded->data->user->result)
            {
                $data->user = $user;
            }
    
            $app->page = new Profile($data);
        });
    }
}

return new ProfileController();