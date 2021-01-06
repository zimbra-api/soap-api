<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\GetAvailableCsvFormatsBody;
use Zimbra\Account\Message\GetAvailableCsvFormatsEnvelope;
use Zimbra\Account\Message\GetAvailableCsvFormatsRequest;
use Zimbra\Account\Message\GetAvailableCsvFormatsResponse;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAvailableCsvFormatsTest.
 */
class GetAvailableCsvFormatsTest extends ZimbraStructTestCase
{
    public function testGetAvailableCsvFormats()
    {
        $name = $this->faker->word;

        $request = new GetAvailableCsvFormatsRequest();

        $csv = new NamedElement($name);
        $response = new GetAvailableCsvFormatsResponse([$csv]);
        $this->assertSame([$csv], $response->getCsvFormats());
        $response = new GetAvailableCsvFormatsResponse();
        $response->setCsvFormats([$csv])
            ->addCsvFormat($csv);
        $this->assertSame([$csv, $csv], $response->getCsvFormats());
        $response->setCsvFormats([$csv]);

        $body = new GetAvailableCsvFormatsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAvailableCsvFormatsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAvailableCsvFormatsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAvailableCsvFormatsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableCsvFormatsRequest />
        <urn:GetAvailableCsvFormatsResponse>
            <csv name="$name" />
        </urn:GetAvailableCsvFormatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAvailableCsvFormatsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAvailableCsvFormatsRequest' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetAvailableCsvFormatsResponse' => [
                    'csv' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAvailableCsvFormatsEnvelope::class, 'json'));
    }
}
