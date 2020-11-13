<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountAccountBody;
use Zimbra\Admin\Message\CountAccountRequest;
use Zimbra\Admin\Message\CountAccountResponse;
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountAccountBody.
 */
class CountAccountBodyTest extends ZimbraStructTestCase
{
    public function testCountAccountBody()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);

        $request = new CountAccountRequest(new DomainSelector(DomainBy::NAME(), $value));
        $response = new CountAccountResponse([new CosCountInfo($name, $id, $count)]);

        $body = new CountAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CountAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CountAccountRequest>'
                    . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '</urn:CountAccountRequest>'
                . '<urn:CountAccountResponse>'
                    . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
                . '</urn:CountAccountResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CountAccountBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CountAccountBody::class, 'json'));
    }
}
