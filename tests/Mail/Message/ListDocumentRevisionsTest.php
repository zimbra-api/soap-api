<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ListDocumentRevisionsEnvelope;
use Zimbra\Mail\Message\ListDocumentRevisionsBody;
use Zimbra\Mail\Message\ListDocumentRevisionsRequest;
use Zimbra\Mail\Message\ListDocumentRevisionsResponse;

use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;
use Zimbra\Mail\Struct\{DocumentInfo, IdEmailName};

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ListDocumentRevisions.
 */
class ListDocumentRevisionsTest extends ZimbraTestCase
{
    public function testListDocumentRevisions()
    {
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;
        $lockOwnerId = $this->faker->uuid;
        $lockOwnerEmail = $this->faker->email;
        $lockOwnerTimestamp = (string) $this->faker->unixTime;
        $email = $this->faker->email;
        $name = $this->faker->name;

        $doc = new ListDocumentRevisionsSpec($id, $version, $count);
        $request = new ListDocumentRevisionsRequest($doc);
        $this->assertSame($doc, $request->getDoc());
        $request = new ListDocumentRevisionsRequest(new ListDocumentRevisionsSpec());
        $request->setDoc($doc);
        $this->assertSame($doc, $request->getDoc());

        $revision = new DocumentInfo(
            $id, $lockOwnerId, $lockOwnerEmail, $lockOwnerTimestamp
        );
        $user = new IdEmailName(
            $id, $email, $name
        );
        $response = new ListDocumentRevisionsResponse([$revision], [$user]);
        $this->assertSame([$revision], $response->getRevisions());
        $this->assertSame([$user], $response->getUsers());
        $response = new ListDocumentRevisionsResponse();
        $response->setRevisions([$revision])
            ->addRevision($revision)
            ->setUsers([$user])
            ->addUser($user);
        $this->assertSame([$revision, $revision], $response->getRevisions());
        $this->assertSame([$user, $user], $response->getUsers());
        $response->setRevisions([$revision])->setUsers([$user]);

        $body = new ListDocumentRevisionsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ListDocumentRevisionsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ListDocumentRevisionsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ListDocumentRevisionsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ListDocumentRevisionsRequest>
            <urn:doc id="$id" ver="$version" count="$count" />
        </urn:ListDocumentRevisionsRequest>
        <urn:ListDocumentRevisionsResponse>
            <urn:doc id="$id" loid="$lockOwnerId" loe="$lockOwnerEmail" lt="$lockOwnerTimestamp" />
            <urn:user id="$id" email="$email" name="$name" />
        </urn:ListDocumentRevisionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ListDocumentRevisionsEnvelope::class, 'xml'));
    }
}
