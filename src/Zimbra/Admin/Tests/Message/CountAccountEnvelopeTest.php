<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountAccountBody;
use Zimbra\Admin\Message\CountAccountEnvelope;
use Zimbra\Admin\Message\CountAccountRequest;
use Zimbra\Admin\Message\CountAccountResponse;
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountAccountEnvelope.
 */
class CountAccountEnvelopeTest extends ZimbraStructTestCase
{
    public function testCountAccountEnvelope()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);

        $request = new CountAccountRequest(new DomainSelector(DomainBy::NAME(), $value));
        $response = new CountAccountResponse([new CosCountInfo($name, $id, $count)]);
        $body = new CountAccountBody($request, $response);

        $envelope = new CountAccountEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CountAccountRequest>'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '</urn:CountAccountRequest>'
                    . '<urn:CountAccountResponse>'
                        . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
                    . '</urn:CountAccountResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountAccountRequest' => [
                    'domain' => [
                        'by' => (string) DomainBy::NAME(),
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CountAccountResponse' => [
                    'cos' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            '_content' => $count,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountAccountEnvelope::class, 'json'));
    }
}
