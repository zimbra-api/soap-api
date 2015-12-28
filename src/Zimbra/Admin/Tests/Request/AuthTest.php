<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\Auth;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for Auth.
 */
class AuthTest extends ZimbraAdminApiTestCase
{
    public function testAuthRequest()
    {
        $name = $this->faker->word;
        $password = $this->faker->sha1;
        $authToken = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $req = new Auth(
        	$name, $password, $authToken, $account, $virtualHost, false
    	);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertFalse($req->getPersistAuthTokenCookie());

        $req->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setAccount($account)
            ->setVirtualHost($virtualHost)
            ->setPersistAuthTokenCookie(true);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertTrue($req->getPersistAuthTokenCookie());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'authToken' => $authToken,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $name,
                ],
                'virtualHost' => $virtualHost,
                'persistAuthTokenCookie' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAuthApi()
    {
        $name = $this->faker->word;
        $password = $this->faker->sha1;
        $authToken = $this->faker->sha1;
        $virtualHost = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $this->api->auth(
            $name, $password, $authToken, $account, $virtualHost, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:authToken>' . $authToken . '</urn1:authToken>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $name . '</urn1:account>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByName()
    {
        $name = $this->faker->word;
        $password = $this->faker->word;
        $virtualHost = $this->faker->word;
        $this->api->authByName(
            $name, $password, $virtualHost
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAccount()
    {
        $name = $this->faker->word;
        $password = $this->faker->sha1;
        $virtualHost = $this->faker->word;
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $name);

        $this->api->authByAccount(
            $account, $password, $virtualHost
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $name . '</urn1:account>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $authToken = $this->faker->sha1;
        $this->api->authByToken(
            $authToken
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest persistAuthTokenCookie="true">'
                        . '<urn1:authToken>' . $authToken . '</urn1:authToken>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
