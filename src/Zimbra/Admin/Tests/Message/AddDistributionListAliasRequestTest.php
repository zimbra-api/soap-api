<?php

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

        $req = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddDistributionListAliasRequest', 'xml');
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());
    }
}
