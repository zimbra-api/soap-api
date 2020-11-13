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
 * Testcase class for AutoCompleteGalEnvelope.
 */
class AutoCompleteGalEnvelopeTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalEnvelope()
    {
        $name = $this->faker->word;
        $galAccountId = $this->faker->word;
        $limit = mt_rand(1, 100);
        $request = new AutoCompleteGalRequest(
            $name,
            GalSearchType::ACCOUNT(),
            FALSE,
            $galAccountId,
            $limit
        );

        $pagingSupported = mt_rand(1, 100);
        $contact = new ContactInfo;
        $response = new AutoCompleteGalResponse(
            FALSE,
            TRUE,
            $pagingSupported,
            [$contact]
        );

        $body = new AutoCompleteGalBody($request, $response);
        $envelope = new AutoCompleteGalEnvelope(NULL, $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoCompleteGalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:AutoCompleteGalRequest name="' . $name . '" type="'. GalSearchType::ACCOUNT() . '" needExp="false" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />'
                    . '<urn:AutoCompleteGalResponse more="false" tokenizeKey="true" pagingSupported="' . $pagingSupported . '">'
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
                    'needExp' => FALSE,
                    'galAcctId' => $galAccountId,
                    'limit' => $limit,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'AutoCompleteGalResponse' => [
                    'more' => FALSE,
                    'tokenizeKey' => TRUE,
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
