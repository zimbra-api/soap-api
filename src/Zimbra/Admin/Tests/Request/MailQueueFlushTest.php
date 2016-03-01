<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\MailQueueFlush;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for MailQueueFlush.
 */
class MailQueueFlushTest extends ZimbraAdminApiTestCase
{
    public function testMailQueueFlushRequest()
    {
        $name = $this->faker->word;
        $server = new NamedElement($name);
        $req = new MailQueueFlush($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MailQueueFlushRequest>'
                . '<server name="' . $name . '" />'
            . '</MailQueueFlushRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MailQueueFlushRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailQueueFlushApi()
    {
        $name = $this->faker->word;
        $server = new NamedElement($name);

        $this->api->mailQueueFlush($server);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MailQueueFlushRequest>'
                        . '<urn1:server name="' . $name . '" />'
                    . '</urn1:MailQueueFlushRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
