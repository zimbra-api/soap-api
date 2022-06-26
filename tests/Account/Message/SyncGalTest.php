<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\SyncGalEnvelope;
use Zimbra\Account\Message\SyncGalBody;
use Zimbra\Account\Message\SyncGalRequest;
use Zimbra\Account\Message\SyncGalResponse;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for SyncGal.
 */
class SyncGalTest extends ZimbraTestCase
{
    public function testSyncGal()
    {
        $id = $this->faker->uuid;
        $token = $this->faker->uuid;
        $galAccountId = $this->faker->uuid;
        $galDefinitionLastModified = $this->faker->text;
        $limit = mt_rand(1, 100);
        $remain = mt_rand(1, 100);
        $email = $this->faker->email;

        $request = new SyncGalRequest($token, $galAccountId, FALSE, FALSE, $limit);
        $this->assertSame($token, $request->getToken());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertFalse($request->getIdOnly());
        $this->assertFalse($request->getCount());
        $this->assertSame($limit, $request->getLimit());

        $request = new SyncGalRequest();
        $request->setToken($token)
            ->setGalAccountId($galAccountId)
            ->setIdOnly(TRUE)
            ->setCount(TRUE)
            ->setLimit($limit);
        $this->assertSame($token, $request->getToken());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertTrue($request->getIdOnly());
        $this->assertTrue($request->getCount());
        $this->assertSame($limit, $request->getLimit());

        $contact = new ContactInfo;
        $contact->setEmail($email);
        $deleted = new Id($id);

        $response = new SyncGalResponse(FALSE, $token, $galDefinitionLastModified, FALSE, FALSE, $remain, [$contact], [$deleted]);
        $this->assertFalse($response->getMore());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($galDefinitionLastModified, $response->getGalDefinitionLastModified());
        $this->assertFalse($response->getThrottled());
        $this->assertFalse($response->getFullSyncRecommended());
        $this->assertSame($remain, $response->getRemain());
        $this->assertSame([$contact], $response->getContacts());
        $this->assertSame([$deleted], $response->getDeleted());

        $response = new SyncGalResponse();
        $response->setMore(TRUE)
            ->setToken($token)
            ->setGalDefinitionLastModified($galDefinitionLastModified)
            ->setThrottled(TRUE)
            ->setFullSyncRecommended(TRUE)
            ->setRemain($remain)
            ->setContacts([$contact])
            ->setDeleted([$deleted]);
        $this->assertTrue($response->getMore());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($galDefinitionLastModified, $response->getGalDefinitionLastModified());
        $this->assertTrue($response->getThrottled());
        $this->assertTrue($response->getFullSyncRecommended());
        $this->assertSame($remain, $response->getRemain());
        $this->assertSame([$contact], $response->getContacts());
        $this->assertSame([$deleted], $response->getDeleted());

        $body = new SyncGalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SyncGalBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SyncGalEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SyncGalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SyncGalRequest token="$token" galAcctId="$galAccountId" idOnly="true" getCount="true" limit="$limit" />
        <urn:SyncGalResponse more="true" token="$token" galDefinitionLastModified="$galDefinitionLastModified" throttled="true" fullSyncRecommended="true" remain="$remain">
            <urn:cn email="$email" />
            <urn:deleted id="$id" />
        </urn:SyncGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SyncGalEnvelope::class, 'xml'));
    }
}
