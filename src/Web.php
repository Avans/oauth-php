<?php
namespace Avans\OAuth;

use League\OAuth1\Client\Server\User;

class Web extends \League\OAuth1\Client\Server\Server {

    /**
     * Get the URL for retrieving temporary credentials.
     *
     * @return string
     */
    public function urlTemporaryCredentials()
    {
        return 'https://publicapi.avans.nl/oauth/request_token';
    }

    /**
     * Get the URL for redirecting the resource owner to authorize the client.
     *
     * @return string
     */
    public function urlAuthorization()
    {
        return 'https://publicapi.avans.nl/oauth/saml.php';
    }

    /**
     * Get the URL retrieving token credentials.
     *
     * @return string
     */
    public function urlTokenCredentials()
    {
        return 'https://publicapi.avans.nl/oauth/access_token';
    }

    /**
     * Get the URL for retrieving user details.
     *
     * @return string
     */
    public function urlUserDetails()
    {
        return 'https://publicapi.avans.nl/oauth/people/@me';
    }

    /**
     * Take the decoded data from the user details URL and convert
     * it to a User object.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return \League\OAuth1\Client\Server\User
     */
    public function userDetails($data, \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials)
    {
        $user = new User();
        $user->uid = $data['id'];
        $user->email = $data['emails'][0];
        $user->nickname = $data['nickname'];
        $user->name = $data['accounts']['username'];
        $user->firstName = $data['name']['givenName'];
        $user->lastName = $data['name']['familyName'];
        $user->location = $data['location'];
        $user->extra['student'] = $data['student'] === 'true';
        $user->extra['employee'] = $data['employee'] === 'true';
        return $user;
    }

    /**
     * Take the decoded data from the user details URL and extract
     * the user's UID.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string|int
     */
    public function userUid($data, \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userUid() method.
    }

    /**
     * Take the decoded data from the user details URL and extract
     * the user's email.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string
     */
    public function userEmail($data, \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userEmail() method.
    }

    /**
     * Take the decoded data from the user details URL and extract
     * the user's screen name.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string
     */
    public function userScreenName($data, \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userScreenName() method.
    }
}