<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetAvailableLocalesBody;
use Zimbra\Account\Message\GetAvailableLocalesEnvelope;
use Zimbra\Account\Message\GetAvailableLocalesRequest;
use Zimbra\Account\Message\GetAvailableLocalesResponse;
use Zimbra\Account\Struct\LocaleInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAvailableLocalesTest.
 */
class GetAvailableLocalesTest extends ZimbraTestCase
{
    public function testGetAvailableLocales()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->locale;
        $localName = $this->faker->country;

        $request = new GetAvailableLocalesRequest();

        $locale = new LocaleInfo($id, $name, $localName);
        $response = new GetAvailableLocalesResponse([$locale]);
        $this->assertSame([$locale], $response->getLocales());
        $response = new GetAvailableLocalesResponse();
        $response->setLocales([$locale])
            ->addLocale($locale);
        $this->assertSame([$locale, $locale], $response->getLocales());
        $response->setLocales([$locale]);

        $body = new GetAvailableLocalesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAvailableLocalesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAvailableLocalesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAvailableLocalesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableLocalesRequest />
        <urn:GetAvailableLocalesResponse>
            <urn:locale id="$id" name="$name" localName="$localName" />
        </urn:GetAvailableLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAvailableLocalesEnvelope::class, 'xml'));
    }
}
