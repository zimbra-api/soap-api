<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetSpellDictionariesEnvelope;
use Zimbra\Mail\Message\GetSpellDictionariesBody;
use Zimbra\Mail\Message\GetSpellDictionariesRequest;
use Zimbra\Mail\Message\GetSpellDictionariesResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetSpellDictionaries.
 */
class GetSpellDictionariesTest extends ZimbraTestCase
{
    public function testGetSpellDictionaries()
    {
        $dictionary1 = $this->faker->unique->word;
        $dictionary2 = $this->faker->unique->word;

        $request = new GetSpellDictionariesRequest();
        $response = new GetSpellDictionariesResponse([$dictionary1, $dictionary2]);
        $this->assertSame([$dictionary1, $dictionary2], $response->getDictionaries());
        $response = new GetSpellDictionariesResponse();
        $response->setDictionaries([$dictionary1])
            ->addDictionary($dictionary2);
        $this->assertSame([$dictionary1, $dictionary2], $response->getDictionaries());

        $body = new GetSpellDictionariesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetSpellDictionariesBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetSpellDictionariesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetSpellDictionariesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSpellDictionariesRequest />
        <urn:GetSpellDictionariesResponse>
            <urn:dictionary>$dictionary1</urn:dictionary>
            <urn:dictionary>$dictionary2</urn:dictionary>
        </urn:GetSpellDictionariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSpellDictionariesEnvelope::class, 'xml'));
    }
}
