<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Response;

use Zimbra\Admin\Message\AutoCompleteGalBody;
use Zimbra\Admin\Message\AutoCompleteGalEnvelope;
use Zimbra\Admin\Message\AutoCompleteGalRequest;
use Zimbra\Admin\Message\AutoCompleteGalResponse;
use Zimbra\Enum\GalSearchType;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGal.
 */
class AutoCompleteGalTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGal()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $limit = mt_rand();

        $request = new AutoCompleteGalRequest($domain, $name, GalSearchType::ALL(), $galAccountId, $limit);
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($name, $request->getName());
        $this->assertEquals(GalSearchType::ALL(), $request->getType());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($limit, $request->getLimit());

        $request = new AutoCompleteGalRequest('', '');
        $request->setDomain($domain)
            ->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccountId($galAccountId)
            ->setLimit($limit);
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($name, $request->getName());
        $this->assertEquals(GalSearchType::ACCOUNT(), $request->getType());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($limit, $request->getLimit());

        $contact = new ContactInfo();
        $response = new AutoCompleteGalResponse(
            FALSE, FALSE, FALSE, [$contact]
        );
        $this->assertFalse($response->getMore());
        $this->assertFalse($response->getTokenizeKey());
        $this->assertFalse($response->getPagingSupported());
        $this->assertSame([$contact], $response->getContacts());

        $response->setMore(TRUE)
            ->setTokenizeKey(TRUE)
            ->setPagingSupported(TRUE)
            ->setContacts([$contact])
            ->addContact($contact);
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertTrue($response->getPagingSupported());
        $this->assertSame([$contact, $contact], $response->getContacts());
        $response->setContacts([$contact]);

        $body = new AutoCompleteGalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoCompleteGalBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AutoCompleteGalEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoCompleteGalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoCompleteGalRequest domain="$domain" name="$name" type="account" galAcctId="$galAccountId" limit="$limit" />
        <urn:AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">
            <cn />
        </urn:AutoCompleteGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoCompleteGalEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AutoCompleteGalRequest' => [
                    'domain' => $domain,
                    'name' => $name,
                    'type' => 'account',
                    'galAcctId' => $galAccountId,
                    'limit' => $limit,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AutoCompleteGalResponse' => [
                    'more' => TRUE,
                    'tokenizeKey' => TRUE,
                    'paginationSupported' => TRUE,
                    'cn' => [
                        new \stdClass
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoCompleteGalEnvelope::class, 'json'));
    }
}
