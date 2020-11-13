<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AutoCompleteGalBody;
use Zimbra\Admin\Message\AutoCompleteGalRequest;
use Zimbra\Admin\Message\AutoCompleteGalResponse;
use Zimbra\Enum\GalSearchType;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalBody.
 */
class AutoCompleteGalBodyTest extends ZimbraStructTestCase
{
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
}
