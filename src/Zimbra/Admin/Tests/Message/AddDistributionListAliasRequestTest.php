<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListAliasRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListAliasRequest.
 */
class AddDistributionListAliasRequestTest extends ZimbraStructTestCase
{
    public function testAddDistributionListAliasRequest()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;

        $req = new AddDistributionListAliasRequest($id, $alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req = new AddDistributionListAliasRequest('', '');
        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddDistributionListAliasRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'alias' => $alias,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddDistributionListAliasRequest::class, 'json'));
    }
}
