<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountAccountRequest;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountAccountRequest.
 */
class CountAccountRequestTest extends ZimbraStructTestCase
{
    public function testCountAccountRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new CountAccountRequest($domain);
        $this->assertSame($domain, $req->getDomain());

        $req = new CountAccountRequest(new DomainSelector(DomainBy::ID(), $value));
        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</CountAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CountAccountRequest::class, 'xml'));

        $json = json_encode([
            'domain' => [
                'by' => (string) DomainBy::NAME(),
                '_content' => $value,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CountAccountRequest::class, 'json'));
    }
}
