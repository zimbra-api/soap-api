<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\DeleteIdentity;
use Zimbra\Account\Struct\NameId;

/**
 * Testcase class for DeleteIdentity.
 */
class DeleteIdentityTest extends ZimbraAccountApiTestCase
{
    public function testDeleteIdentityRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $identity = new NameId($name, $id);
        $req = new DeleteIdentity($identity);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($identity, $req->getIdentity());

        $req->setIdentity($identity);
        $this->assertSame($identity, $req->getIdentity());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteIdentityRequest>'
                . '<identity name="' . $name . '" id="' . $id . '" />'
            . '</DeleteIdentityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteIdentityRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'identity' => [
                    'name' => $name,
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteIdentityApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $identity = new NameId($name, $id);

        $this->api->deleteIdentity(
            $identity
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DeleteIdentityRequest>'
                        . '<urn1:identity name="' . $name . '" id="' . $id . '" />'
                    . '</urn1:DeleteIdentityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
