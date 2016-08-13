<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\EnableTwoFactorAuth;
use Zimbra\Account\Struct\AuthToken;

/**
 * Testcase class for EnableTwoFactorAuth.
 */
class EnableTwoFactorAuthTest extends ZimbraAccountApiTestCase
{
    public function testEnableTwoFactorAuthRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->word;
        $twoFactorCode = $this->faker->word;
        $authToken = new AuthToken($value, true);

        $req = new EnableTwoFactorAuth(
            $name, $password, $authToken, $twoFactorCode, true
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertTrue($req->getCsrfSupported());

        $req = new EnableTwoFactorAuth('');
        $req->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setTwoFactorCode($twoFactorCode)
            ->setCsrfSupported(false);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());
        $this->assertFalse($req->getCsrfSupported());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<EnableTwoFactorAuthRequest csrfTokenSecured="false">'
                . '<name>' . $name . '</name>'
                . '<password>' . $password . '</password>'
                . '<authToken verifyAccount="true">' . $value . '</authToken>'
                . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
            . '</EnableTwoFactorAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'EnableTwoFactorAuthRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'name' => $name,
                'password' => $password,
                'authToken' => [
                    'verifyAccount' => true,
                    '_content' => $value,
                ],
                'twoFactorCode' => $twoFactorCode,
                'csrfTokenSecured' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testEnableTwoFactorAuthApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->word;
        $twoFactorCode = $this->faker->word;
        $authToken = new AuthToken($value, true);

        $this->api->enableTwoFactorAuth(
            $name, $password, $authToken, $twoFactorCode, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:EnableTwoFactorAuthRequest csrfTokenSecured="true">'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:authToken verifyAccount="true">' . $value . '</urn1:authToken>'
                        . '<urn1:twoFactorCode>' . $twoFactorCode . '</urn1:twoFactorCode>'
                    . '</urn1:EnableTwoFactorAuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
