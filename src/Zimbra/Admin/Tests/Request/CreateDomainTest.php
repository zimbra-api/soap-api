<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateDomain;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateDomain.
 */
class CreateDomainTest extends ZimbraAdminApiTestCase
{
    public function testCreateDomainRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateDomain($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDomainApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $attr = new KeyValuePair($key, $value);

        $this->api->createDomain(
            $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDomainRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateDomainRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
