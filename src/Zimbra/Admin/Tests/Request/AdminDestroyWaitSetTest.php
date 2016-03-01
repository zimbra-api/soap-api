<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AdminDestroyWaitSet;

/**
 * Testcase class for AdminDestroyWaitSet.
 */
class AdminDestroyWaitSetTest extends ZimbraAdminApiTestCase
{
    public function testAdminDestroyWaitSetRequest()
    {
        $waitSet = $this->faker->word;
        $req = new AdminDestroyWaitSet($waitSet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $req->setWaitSetId($waitSet);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminDestroyWaitSetRequest waitSet="' . $waitSet . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminDestroyWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminDestroyWaitSetApi()
    {
        $waitSet = $this->faker->word;
        $this->api->adminDestroyWaitSet(
            $waitSet
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminDestroyWaitSetRequest '
                        . 'waitSet="' . $waitSet . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
