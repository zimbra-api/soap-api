<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AutoCompleteGalBody;
use Zimbra\Admin\Message\AutoCompleteGalEnvelope;
use Zimbra\Admin\Message\AutoCompleteGalRequest;
use Zimbra\Admin\Message\AutoCompleteGalResponse;
use Zimbra\Enum\GalSearchType;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGal.
 */
class AutoCompleteGalTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalRequest()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $limit = mt_rand();

        $req = new AutoCompleteGalRequest($domain, $name, GalSearchType::ALL(), $galAccountId, $limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ALL(), $req->getType());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req = new AutoCompleteGalRequest('', '');
        $req->setDomain($domain)
            ->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccountId($galAccountId)
            ->setLimit($limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ACCOUNT(), $req->getType());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoCompleteGalRequest::class, 'xml'));

        $json = json_encode([
            'domain' => $domain,
            'name' => $name,
            'type' => GalSearchType::ACCOUNT(),
            'galAcctId' => $galAccountId,
            'limit' => $limit,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoCompleteGalRequest::class, 'json'));
    }

    public function testAutoCompleteGalResponse()
    {
        $contact = new ContactInfo();

        $res = new AutoCompleteGalResponse(
            FALSE, FALSE, FALSE, [$contact]
        );
        $this->assertFalse($res->getMore());
        $this->assertFalse($res->getTokenizeKey());
        $this->assertFalse($res->getPagingSupported());
        $this->assertSame([$contact], $res->getContacts());

        $res->setMore(TRUE)
            ->setTokenizeKey(TRUE)
            ->setPagingSupported(TRUE)
            ->setContacts([$contact])
            ->addContact($contact);
        $this->assertTrue($res->getMore());
        $this->assertTrue($res->getTokenizeKey());
        $this->assertTrue($res->getPagingSupported());
        $this->assertSame([$contact, $contact], $res->getContacts());

        $res = new AutoCompleteGalResponse(
            TRUE, TRUE, TRUE, [$contact]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">'
                . '<cn />'
            . '</AutoCompleteGalResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoCompleteGalResponse::class, 'xml'));

        $json = json_encode([
            'more' => TRUE,
            'tokenizeKey' => TRUE,
            'paginationSupported' => TRUE,
            'cn' => [
                new \stdClass
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoCompleteGalResponse::class, 'json'));
    }

    public function testAutoCompleteGalBody()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $limit = mt_rand();

        $contact = new ContactInfo();
        $request = new AutoCompleteGalRequest($domain, $name, GalSearchType::ACCOUNT(), $galAccountId, $limit);
        $response = new AutoCompleteGalResponse(
            TRUE, TRUE, TRUE, [$contact]
        );

        $body = new AutoCompleteGalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoCompleteGalBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />'
                . '<urn:AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">'
                    . '<cn />'
                . '</urn:AutoCompleteGalResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AutoCompleteGalBody::class, 'xml'));

        $json = json_encode([
            'AutoCompleteGalRequest' => [
                'domain' => $domain,
                'name' => $name,
                'type' => (string) GalSearchType::ACCOUNT(),
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AutoCompleteGalBody::class, 'json'));
    }

    public function testAutoCompleteGalEnvelope()
    {
        $domain = $this->faker->word;
        $name = $this->faker->word;
        $galAccountId = $this->faker->uuid;
        $limit = mt_rand();

        $contact = new ContactInfo();
        $request = new AutoCompleteGalRequest($domain, $name, GalSearchType::ACCOUNT(), $galAccountId, $limit);
        $response = new AutoCompleteGalResponse(
            TRUE, TRUE, TRUE, [$contact]
        );
        $body = new AutoCompleteGalBody($request, $response);

        $envelope = new AutoCompleteGalEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoCompleteGalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />'
                    . '<urn:AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">'
                        . '<cn />'
                    . '</urn:AutoCompleteGalResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoCompleteGalEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AutoCompleteGalRequest' => [
                    'domain' => $domain,
                    'name' => $name,
                    'type' => (string) GalSearchType::ACCOUNT(),
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoCompleteGalEnvelope::class, 'json'));
    }
}
