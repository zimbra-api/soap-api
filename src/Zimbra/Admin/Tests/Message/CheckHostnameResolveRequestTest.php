<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHostnameResolveRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHostnameResolveRequest.
 */
class CheckHostnameResolveRequestTest extends ZimbraStructTestCase
{
    public function testCheckHostnameResolveRequest()
    {
        $hostname = $this->faker->word;

        $req = new CheckHostnameResolveRequest($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $req = new CheckHostnameResolveRequest('');
        $req->setHostname($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveRequest hostname="' . $hostname . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckHostnameResolveRequest::class, 'xml'));

        $json = json_encode([
            'hostname' => $hostname,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckHostnameResolveRequest::class, 'json'));
    }
}
