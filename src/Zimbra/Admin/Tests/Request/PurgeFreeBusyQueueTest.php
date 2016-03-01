<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\PurgeFreeBusyQueue;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for PurgeFreeBusyQueue.
 */
class PurgeFreeBusyQueueTest extends ZimbraAdminApiTestCase
{
    public function testPurgeFreeBusyQueueRequest()
    {
        $name = $this->faker->word;
        $provider = new NamedElement($name);
        $req = new PurgeFreeBusyQueue($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($provider, $req->getProvider());
        $req->setProvider($provider);
        $this->assertEquals($provider, $req->getProvider());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeFreeBusyQueueRequest>'
                . '<provider name="' . $name . '" />'
            . '</PurgeFreeBusyQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeFreeBusyQueueRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'provider' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeFreeBusyQueueApi()
    {
        $name = $this->faker->word;
        $provider = new NamedElement($name);

        $this->api->purgeFreeBusyQueue(
            $provider
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeFreeBusyQueueRequest>'
                        . '<urn1:provider name="' . $name . '" />'
                    . '</urn1:PurgeFreeBusyQueueRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
