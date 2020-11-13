<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AutoCompleteGalBody;
use Zimbra\Admin\Message\AutoCompleteGalEnvelope;
use Zimbra\Admin\Message\AutoCompleteGalRequest;
use Zimbra\Admin\Message\AutoCompleteGalResponse;
use Zimbra\Enum\GalSearchType;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalEnvelope.
 */
class AutoCompleteGalEnvelopeTest extends ZimbraStructTestCase
{
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
