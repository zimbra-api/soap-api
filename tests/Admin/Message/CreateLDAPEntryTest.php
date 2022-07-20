<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateLDAPEntryBody;
use Zimbra\Admin\Message\CreateLDAPEntryEnvelope;
use Zimbra\Admin\Message\CreateLDAPEntryRequest;
use Zimbra\Admin\Message\CreateLDAPEntryResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateLDAPEntry.
 */
class CreateLDAPEntryTest extends ZimbraTestCase
{
    public function testCreateLDAPEntry()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $dn = $this->faker->word;

        $attr = new Attr($key, $value);
        $ldap = new LDAPEntryInfo($name, [$attr]);

        $request = new CreateLDAPEntryRequest(
            $dn, [$attr]
        );
        $this->assertSame($dn, $request->getDn());
        $request = new CreateLDAPEntryRequest('');
        $request->setDn($dn)
            ->setAttrs([$attr]);
        $this->assertSame($dn, $request->getDn());

        $response = new CreateLDAPEntryResponse($ldap);
        $this->assertSame($ldap, $response->getLDAPEntry());
        $response = new CreateLDAPEntryResponse(new LDAPEntryInfo(''));
        $response->setLDAPEntry($ldap);
        $this->assertSame($ldap, $response->getLDAPEntry());

        $body = new CreateLDAPEntryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateLDAPEntryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateLDAPEntryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateLDAPEntryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateLDAPEntryRequest dn="$dn">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateLDAPEntryRequest>
        <urn:CreateLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:CreateLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateLDAPEntryEnvelope::class, 'xml'));
    }
}
