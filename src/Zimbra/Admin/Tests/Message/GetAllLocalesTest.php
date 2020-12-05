<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllLocalesBody;
use Zimbra\Admin\Message\GetAllLocalesEnvelope;
use Zimbra\Admin\Message\GetAllLocalesRequest;
use Zimbra\Admin\Message\GetAllLocalesResponse;
use Zimbra\Admin\Struct\LocaleInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllLocalesTest.
 */
class GetAllLocalesTest extends ZimbraStructTestCase
{
    public function testGetAllLocales()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $localName = $this->faker->word;

        $locale = new LocaleInfo($id, $name, $localName);

        $request = new GetAllLocalesRequest();

        $response = new GetAllLocalesResponse([$locale]);
        $this->assertSame([$locale], $response->getLocales());
        $response = new GetAllLocalesResponse();
        $response->setLocales([$locale])
            ->addLocale($locale);
        $this->assertSame([$locale, $locale], $response->getLocales());
        $response->setLocales([$locale]);

        $body = new GetAllLocalesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllLocalesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllLocalesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllLocalesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllLocalesRequest />
        <urn:GetAllLocalesResponse>
            <locale id="$id" name="$name" localName="$localName" />
        </urn:GetAllLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllLocalesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllLocalesRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllLocalesResponse' => [
                    'locale' => [
                        [
                            'id' => $id,
                            'name' => $name,
                            'localName' => $localName,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllLocalesEnvelope::class, 'json'));
    }
}
