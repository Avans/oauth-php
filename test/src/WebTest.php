<?php
/**
 * User: hameijer
 * Date: 21-9-17
 * Time: 15:00
 */

namespace Avans\OAuth;

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
}
