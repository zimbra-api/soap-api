<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\CreateAppSpecificPassword;

/**
 * Testcase class for CreateAppSpecificPassword.
 */
class CreateAppSpecificPasswordTest extends ZimbraAccountApiTestCase
{
    public function testCreateAppSpecificPasswordRequest()
    {
        $appName = $this->faker->word;

        $req = new CreateAppSpecificPassword(
            $appName
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($appName, $req->getAppName());

        $req = new CreateAppSpecificPassword();
        $req->setAppName($appName);
        $this->assertSame($appName, $req->getAppName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAppSpecificPasswordRequest appName="' . $appName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateAppSpecificPasswordRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'appName' => $appName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAppSpecificPasswordApi()
    {
        $appName = $this->faker->word;

        $this->api->createAppSpecificPassword(
            $appName
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateAppSpecificPasswordRequest appName="' . $appName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
