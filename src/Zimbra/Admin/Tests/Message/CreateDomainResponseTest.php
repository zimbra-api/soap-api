<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDomainResponse;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDomainResponse.
 */
class CreateDomainResponseTest extends ZimbraStructTestCase
{
    public function testCreateDomainResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $domain = new DomainInfo($name, $id, [$attr]);

        $res = new CreateDomainResponse($domain);
        $this->assertSame($domain, $res->getDomain());

        $res = new CreateDomainResponse(new DomainInfo('', ''));
        $res->setDomain($domain);
        $this->assertSame($domain, $res->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainResponse>'
                . '<domain name="' . $name . '" id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</domain>'
            . '</CreateDomainResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateDomainResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateDomainResponse::class, 'json'));
    }
}
