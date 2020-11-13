<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckDomainMXRecordRequest;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDomainMXRecordRequest.
 */
class CheckDomainMXRecordRequestTest extends ZimbraStructTestCase
{
    public function testCheckDomainMXRecordRequest()
    {
        $name = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $name);
        $req = new CheckDomainMXRecordRequest(
            $domain
        );

        $this->assertSame($domain, $req->getDomain());

        $req = new CheckDomainMXRecordRequest(
            new DomainSelector(DomainBy::NAME(), $name)
        );
        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDomainMXRecordRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $name . '</domain>'
            . '</CheckDomainMXRecordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckDomainMXRecordRequest::class, 'xml'));

        $json = json_encode([
            'domain' => [
                'by' => (string) DomainBy::NAME(),
                '_content' => $name,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckDomainMXRecordRequest::class, 'json'));
    }
}
