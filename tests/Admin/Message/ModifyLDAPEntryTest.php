<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyLDAPEntryBody;
use Zimbra\Admin\Message\ModifyLDAPEntryEnvelope;
use Zimbra\Admin\Message\ModifyLDAPEntryRequest;
use Zimbra\Admin\Message\ModifyLDAPEntryResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyLDAPEntry.
 */
class ModifyLDAPEntryTest extends ZimbraTestCase
{
    public function testModifyLDAPEntry()
    {
        $dn = $this->faker->word;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyLDAPEntryRequest($dn);
        $this->assertSame($dn, $request->getDn());
        $request = new ModifyLDAPEntryRequest('');
        $request->setDn($dn)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($dn, $request->getDn());

        $LDAPEntry = new LDAPEntryInfo($name, [new Attr($key, $value)]);
        $response = new ModifyLDAPEntryResponse($LDAPEntry);
        $this->assertSame($LDAPEntry, $response->getLDAPEntry());
        $response = new ModifyLDAPEntryResponse();
        $response->setLDAPEntry($LDAPEntry);
        $this->assertSame($LDAPEntry, $response->getLDAPEntry());

        $body = new ModifyLDAPEntryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyLDAPEntryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyLDAPEntryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyLDAPEntryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyLDAPEntryRequest dn="$dn">
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyLDAPEntryRequest>
        <urn:ModifyLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:ModifyLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyLDAPEntryEnvelope::class, 'xml'));
    }
}
