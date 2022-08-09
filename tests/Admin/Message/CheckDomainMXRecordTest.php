<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckDomainMXRecordBody;
use Zimbra\Admin\Message\CheckDomainMXRecordEnvelope;
use Zimbra\Admin\Message\CheckDomainMXRecordRequest;
use Zimbra\Admin\Message\CheckDomainMXRecordResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckDomainMXRecord.
 */
class CheckDomainMXRecordTest extends ZimbraTestCase
{
    public function testCheckDomainMXRecord()
    {
        $name = $this->faker->freeEmailDomain;
        $entry = $this->faker->word;
        $entry1 = $this->faker->unique->word;
        $entry2 = $this->faker->unique->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $name);
        $request = new CheckDomainMXRecordRequest(
            $domain
        );
        $this->assertSame($domain, $request->getDomain());
        $request = new CheckDomainMXRecordRequest(
            new DomainSelector()
        );
        $request->setDomain($domain);
        $this->assertSame($domain, $request->getDomain());

        $response = new CheckDomainMXRecordResponse(
            [$entry],
            $code,
            $message
        );
        $this->assertSame([$entry], $response->getEntries());
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());

        $response = new CheckDomainMXRecordResponse();
        $response->setCode($code)
            ->setMessage($message)
            ->setEntries([$entry1, $entry2]);
        $this->assertSame([$entry1, $entry2], $response->getEntries());
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $response->setEntries([$entry]);

        $body = new CheckDomainMXRecordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckDomainMXRecordBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckDomainMXRecordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckDomainMXRecordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckDomainMXRecordRequest>
            <urn:domain by="name">$name</urn:domain>
        </urn:CheckDomainMXRecordRequest>
        <urn:CheckDomainMXRecordResponse>
            <urn:entry>$entry</urn:entry>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
        </urn:CheckDomainMXRecordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckDomainMXRecordEnvelope::class, 'xml'));
    }
}
