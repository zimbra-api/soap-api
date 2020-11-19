<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AutoCompleteGalEnvelope;
use Zimbra\Account\Message\AutoCompleteGalBody;
use Zimbra\Account\Message\AutoCompleteGalRequest;
use Zimbra\Account\Message\AutoCompleteGalResponse;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Enum\GalSearchType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for AutoCompleteGal.
 */
class AutoCompleteGalTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGal()
    {
        $name = $this->faker->word;
        $galAccountId = $this->faker->word;
        $limit = mt_rand(1, 100);
        $request = new AutoCompleteGalRequest(
            $name,
            GalSearchType::ALL(),
            FALSE,
            $galAccountId,
            $limit
        );
        $this->assertSame($name, $request->getName());
        $this->assertEquals(GalSearchType::ALL(), $request->getType());
        $this->assertFalse($request->getNeedCanExpand());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($limit, $request->getLimit());

        $request = new AutoCompleteGalRequest('');
        $request->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setNeedCanExpand(TRUE)
            ->setGalAccountId($galAccountId)
            ->setLimit($limit);
        $this->assertSame($name, $request->getName());
        $this->assertEquals(GalSearchType::ACCOUNT(), $request->getType());
        $this->assertTrue($request->getNeedCanExpand());
        $this->assertSame($galAccountId, $request->getGalAccountId());
        $this->assertSame($limit, $request->getLimit());

        $pagingSupported = mt_rand(1, 100);
        $contact = new ContactInfo;
        $response = new AutoCompleteGalResponse(
            FALSE,
            TRUE,
            $pagingSupported,
            [$contact]
        );
        $this->assertFalse($response->getMore());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertSame($pagingSupported, $response->getPagingSupported());
        $this->assertSame([$contact], $response->getContacts());

        $response = new AutoCompleteGalResponse();
        $response->setMore(TRUE)
            ->setTokenizeKey(FALSE)
            ->setPagingSupported($pagingSupported)
            ->setContacts([$contact])
            ->addContact($contact);
        $this->assertTrue($response->getMore());
        $this->assertFalse($response->getTokenizeKey());
        $this->assertSame($pagingSupported, $response->getPagingSupported());
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:AutoCompleteGalRequest name="' . $name . '" type="'. GalSearchType::ACCOUNT() . '" needExp="true" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />'
                    . '<urn:AutoCompleteGalResponse more="true" tokenizeKey="false" pagingSupported="' . $pagingSupported . '">'
                        . '<cn />'
                    . '</urn:AutoCompleteGalResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoCompleteGalEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AutoCompleteGalRequest' => [
                    'name' => $name,
                    'type' => (string) GalSearchType::ACCOUNT(),
                    'needExp' => TRUE,
                    'galAcctId' => $galAccountId,
                    'limit' => $limit,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'AutoCompleteGalResponse' => [
                    'more' => TRUE,
                    'tokenizeKey' => FALSE,
                    'pagingSupported' => $pagingSupported,
                    'cn' => [
                        new \stdClass,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoCompleteGalEnvelope::class, 'json'));
    }
}
