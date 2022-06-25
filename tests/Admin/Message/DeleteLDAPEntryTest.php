<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteLDAPEntryBody;
use Zimbra\Admin\Message\DeleteLDAPEntryEnvelope;
use Zimbra\Admin\Message\DeleteLDAPEntryRequest;
use Zimbra\Admin\Message\DeleteLDAPEntryResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteLDAPEntry.
 */
class DeleteLDAPEntryTest extends ZimbraTestCase
{
    public function testDeleteLDAPEntry()
    {
        $dn = $this->faker->word;
        $request = new DeleteLDAPEntryRequest($dn);
        $this->assertSame($dn, $request->getDn());
        $request = new DeleteLDAPEntryRequest('');
        $request->setDn($dn);
        $this->assertSame($dn, $request->getDn());

        $response = new DeleteLDAPEntryResponse();

        $body = new DeleteLDAPEntryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteLDAPEntryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteLDAPEntryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteLDAPEntryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteLDAPEntryRequest dn="$dn" />
        <urn:DeleteLDAPEntryResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteLDAPEntryEnvelope::class, 'xml'));
    }
}
