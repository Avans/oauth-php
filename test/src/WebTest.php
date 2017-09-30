<?php
/**
 * User: hameijer
 * Date: 21-9-17
 * Time: 15:00
 */

namespace Avans\OAuth;

use League\OAuth1\Client\Credentials\TokenCredentials;
use PHPUnit\Framework\TestCase;

class WebTest extends TestCase
{
    public function testUrlTemporaryCredentials() {
        $connector = new Web([
            'identifier' => "identifier",
            "secret" => "secr3t",
            'callback_uri' => 'http://sso.aii.avans.nl'
        ]);;
        $this->assertEquals('https://publicapi.avans.nl/oauth/request_token', $connector->urlTemporaryCredentials());
    }
    public function testUrlAuthorization() {
        $connector = new Web([
            'identifier' => "identifier",
            "secret" => "secr3t",
            'callback_uri' => 'http://sso.aii.avans.nl'
        ]);;
        $this->assertEquals('https://publicapi.avans.nl/oauth/saml.php', $connector->urlAuthorization());
    }
    public function testUrlTokenCredentials() {
        $connector = new Web([
            'identifier' => "identifier",
            "secret" => "secr3t",
            'callback_uri' => 'http://sso.aii.avans.nl'
        ]);;
        $this->assertEquals('https://publicapi.avans.nl/oauth/access_token', $connector->urlTokenCredentials());
    }
    public function testGetUserDetails() {
        $connector = new class([
            'identifier' => "identifier",
            "secret" => "secr3t",
            'callback_uri' => 'http://sso.aii.avans.nl'
        ]) extends Web {

            protected function fetchUserDetails(TokenCredentials $tokenCredentials, $force = true)
            {
                return [
                    'id' => 'userid',
                    'emails' => [
                        'userid@example.com'
                    ],
                    'nickname' => 'John Doo',
                    'accounts' => [
                        'username' => 'username'
                    ],
                    'name' => [
                        'givenName' => 'John',
                        'familyName' => 'Doo'
                    ],
                    'location' => 'Home Sweet Home',
                    'student' => 'false',
                    'employee' => 'true'
                ];
            }
        };

        $user = $connector->getUserDetails(new TokenCredentials());

        $this->assertEquals('userid', $user->uid);
        $this->assertEquals('userid@example.com', $user->email);
        $this->assertEquals('John Doo', $user->nickname);
        $this->assertEquals('username', $user->name);
        $this->assertEquals('John', $user->firstName);
        $this->assertEquals('Doo', $user->lastName);
        $this->assertEquals('Home Sweet Home', $user->location);
        $this->assertEquals(false, $user->extra['student']);
        $this->assertEquals(true, $user->extra['employee']);
    }
}
