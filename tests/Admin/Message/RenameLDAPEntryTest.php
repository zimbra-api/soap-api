<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RenameLDAPEntryBody;
use Zimbra\Admin\Message\RenameLDAPEntryEnvelope;
use Zimbra\Admin\Message\RenameLDAPEntryRequest;
use Zimbra\Admin\Message\RenameLDAPEntryResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RenameLDAPEntry.
 */
class RenameLDAPEntryTest extends ZimbraTestCase
{
    public function testRenameLDAPEntry()
    {
        $dn = $this->faker->word;
        $newDn = $this->faker->word;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new RenameLDAPEntryRequest(
            $dn, $newDn
        );
        $this->assertSame($dn, $request->getDn());
        $this->assertSame($newDn, $request->getNewDn());
        $request = new RenameLDAPEntryRequest('', '');
        $request->setDn($dn)
            ->setNewDn($newDn);
        $this->assertSame($dn, $request->getDn());
        $this->assertSame($newDn, $request->getNewDn());

        $LDAPEntry = new LDAPEntryInfo($name, [new Attr($key, $value)]);
        $response = new RenameLDAPEntryResponse($LDAPEntry);
        $this->assertEquals($LDAPEntry, $response->getLDAPentry());
        $response = new RenameLDAPEntryResponse(new LDAPEntryInfo(''));
        $response->setLDAPentry($LDAPEntry);
        $this->assertEquals($LDAPEntry, $response->getLDAPentry());

        $body = new RenameLDAPEntryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RenameLDAPEntryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameLDAPEntryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameLDAPEntryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameLDAPEntryRequest dn="$dn" new_dn="$newDn" />
        <urn:RenameLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:RenameLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameLDAPEntryEnvelope::class, 'xml'));
    }
}
