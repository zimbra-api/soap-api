<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDomainBody;
use Zimbra\Admin\Message\CreateDomainRequest;
use Zimbra\Admin\Message\CreateDomainResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDomainBody.
 */
class CreateDomainBodyTest extends ZimbraStructTestCase
{
    public function testCreateDomainBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateDomainRequest name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateDomainRequest>'
                . '<urn:CreateDomainResponse>'
                    . '<domain name="' . $name . '" id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</domain>'
                . '</urn:CreateDomainResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateDomainBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateDomainBody::class, 'json'));
    }
}
