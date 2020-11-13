<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountAliasBody;
use Zimbra\Admin\Message\AddAccountAliasRequest;
use Zimbra\Admin\Message\AddAccountAliasResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountAliasBody.
 */
class AddAccountAliasBodyTest extends ZimbraStructTestCase
{
    public function testAddAccountAliasBody()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;
        $request = new AddAccountAliasRequest($id, $alias);
        $response = new AddAccountAliasResponse();

        $body = new AddAccountAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddAccountAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddAccountAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                . '<urn:AddAccountAliasResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddAccountAliasBody::class, 'xml'));

        $json = json_encode([
            'AddAccountAliasRequest' => [
                'id' => $id,
                'alias' => $alias,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddAccountAliasResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddAccountAliasBody::class, 'json'));
    }
}
