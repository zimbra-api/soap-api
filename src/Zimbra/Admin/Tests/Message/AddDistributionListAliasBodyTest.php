<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListAliasBody;
use Zimbra\Admin\Message\AddDistributionListAliasRequest;
use Zimbra\Admin\Message\AddDistributionListAliasResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListAliasBody.
 */
class AddDistributionListAliasBodyTest extends ZimbraStructTestCase
{
    public function testAddDistributionListAliasBody()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;
        $request = new AddDistributionListAliasRequest($id, $alias);
        $response = new AddDistributionListAliasResponse();

        $body = new AddDistributionListAliasBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListAliasBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                . '<urn:AddDistributionListAliasResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddDistributionListAliasBody::class, 'xml'));

        $json = json_encode([
            'AddDistributionListAliasRequest' => [
                'id' => $id,
                'alias' => $alias,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddDistributionListAliasResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddDistributionListAliasBody::class, 'json'));
    }
}
