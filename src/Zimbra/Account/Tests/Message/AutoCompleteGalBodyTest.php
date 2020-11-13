<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AutoCompleteGalBody;
use Zimbra\Account\Message\AutoCompleteGalRequest;
use Zimbra\Account\Message\AutoCompleteGalResponse;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Enum\GalSearchType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalBody.
 */
class AutoCompleteGalBodyTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalBody()
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

        $pagingSupported = mt_rand(1, 100);
        $contact = new ContactInfo;
        $response = new AutoCompleteGalResponse(
            FALSE,
            TRUE,
            $pagingSupported,
            [$contact]
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
            . '<Body xmlns:urn="urn:zimbraAccount">'
                . '<urn:AutoCompleteGalRequest name="' . $name . '" type="'. GalSearchType::ALL() . '" needExp="false" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />'
                . '<urn:AutoCompleteGalResponse more="false" tokenizeKey="true" pagingSupported="' . $pagingSupported . '">'
                    . '<cn />'
                . '</urn:AutoCompleteGalResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AutoCompleteGalBody::class, 'xml'));

        $json = json_encode([
            'AutoCompleteGalRequest' => [
                'name' => $name,
                'type' => (string) GalSearchType::ALL(),
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
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AutoCompleteGalBody::class, 'json'));
    }
}
