<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DistributionListMembershipInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListMembershipInfo.
 */
class DistributionListMembershipInfoTest extends ZimbraStructTestCase
{
    public function testDistributionListMembershipInfo()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $via = $this->faker->word;

        $dl = new DistributionListMembershipInfo($id, $name, $via);
        $this->assertSame($id, $dl->getId());
        $this->assertSame($name, $dl->getName());
        $this->assertSame($via, $dl->getVia());

        $dl = new DistributionListMembershipInfo('', '');
        $dl->setId($id)
            ->setName($name)
            ->setVia($via);
        $this->assertSame($id, $dl->getId());
        $this->assertSame($name, $dl->getName());
        $this->assertSame($via, $dl->getVia());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl id="' . $id . '" name="' . $name . '" via="' . $via . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListMembershipInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'via' => $via,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListMembershipInfo::class, 'json'));
    }
}
