<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetAllLocalesBody;
use Zimbra\Account\Message\GetAllLocalesEnvelope;
use Zimbra\Account\Message\GetAllLocalesRequest;
use Zimbra\Account\Message\GetAllLocalesResponse;
use Zimbra\Account\Struct\LocaleInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllLocalesTest.
 */
class GetAllLocalesTest extends ZimbraTestCase
{
    public function testGetAllLocales()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->locale;
        $localName = $this->faker->countryCode;

        $request = new GetAllLocalesRequest();

        $locale = new LocaleInfo($id, $name, $localName);
        $response = new GetAllLocalesResponse([$locale]);
        $this->assertSame([$locale], $response->getLocales());
        $response = new GetAllLocalesResponse();
        $response->setLocales([$locale]);
        $this->assertSame([$locale], $response->getLocales());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAllLocalesRequest />
        <urn:GetAllLocalesResponse>
            <urn:locale id="$id" name="$name" localName="$localName" />
        </urn:GetAllLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllLocalesEnvelope::class, 'xml'));
    }
}
