<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDomainBody;
use Zimbra\Admin\Message\CreateDomainEnvelope;
use Zimbra\Admin\Message\CreateDomainRequest;
use Zimbra\Admin\Message\CreateDomainResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDomainEnvelope.
 */
class CreateDomainEnvelopeTest extends ZimbraStructTestCase
{
    public function testCreateDomainEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $domain = new DomainInfo($name, $id, [$attr]);
        $request = new CreateDomainRequest(
            $name, [$attr]
        );
        $response = new CreateDomainResponse($domain);

        $body = new CreateDomainBody($request, $response);
        $envelope = new CreateDomainEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateDomainRequest name="' . $name . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateDomainRequest>'
                    . '<urn:CreateDomainResponse>'
                        . '<domain name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</domain>'
                    . '</urn:CreateDomainResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDomainEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateDomainRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateDomainResponse' => [
                    'domain' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDomainEnvelope::class, 'json'));
    }
}
