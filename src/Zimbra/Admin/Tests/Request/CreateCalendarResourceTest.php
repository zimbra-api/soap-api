<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateCalendarResource;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CreateCalendarResource.
 */
class CreateCalendarResourceTest extends ZimbraAdminApiTestCase
{
    public function testCreateCalendarResourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $req = new CreateCalendarResource($name, $password, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req->setName($name)
            ->setPassword($password);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
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

    public function testCreateCalendarResourceApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $this->api->createCalendarResource(
            $name, $password, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateCalendarResourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
