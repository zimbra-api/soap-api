<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\RestoreResolve;

use Zimbra\Mail\Message\RestoreContactsEnvelope;
use Zimbra\Mail\Message\RestoreContactsBody;
use Zimbra\Mail\Message\RestoreContactsRequest;
use Zimbra\Mail\Message\RestoreContactsResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RestoreContacts.
 */
class RestoreContactsTest extends ZimbraTestCase
{
    public function testRestoreContacts()
    {
        $fileName = $this->faker->word;
        $resolve = RestoreResolve::RESET;

        $request = new RestoreContactsRequest($fileName, $resolve);
        $this->assertSame($fileName, $request->getContactsBackupFileName());
        $this->assertSame($resolve, $request->getResolve());
        $request = new RestoreContactsRequest();
        $request->setContactsBackupFileName($fileName)
            ->setResolve($resolve);
        $this->assertSame($fileName, $request->getContactsBackupFileName());
        $this->assertSame($resolve, $request->getResolve());

        $response = new RestoreContactsResponse();

        $body = new RestoreContactsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RestoreContactsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RestoreContactsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RestoreContactsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RestoreContactsRequest contactsBackupFileName="$fileName" resolve="reset" />
        <urn:RestoreContactsResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RestoreContactsEnvelope::class, 'xml'));
    }
}
