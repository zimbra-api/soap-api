<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListSubscribeReq.
 */
class DistributionListSubscribeReqTest extends ZimbraStructTestCase
{
    public function testDistributionListSubscribeReq()
    {
        $value = $this->faker->word;
        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE(), $value, false);
        $this->assertEquals(DLSubscribeOp::UNSUBSCRIBE(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertFalse($subsReq->getBccOwners());

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE());
        $subsReq->setOp(DLSubscribeOp::SUBSCRIBE())
                ->setValue($value)
                ->setBccOwners(true);
        $this->assertEquals(DLSubscribeOp::SUBSCRIBE(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertTrue($subsReq->getBccOwners());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($subsReq, 'xml'));
        $this->assertEquals($subsReq, $this->serializer->deserialize($xml, DistributionListSubscribeReq::class, 'xml'));

        $json = json_encode([
            'op' => (string) DLSubscribeOp::SUBSCRIBE(),
            '_content' => $value,
            'bccOwners' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($subsReq, 'json'));
        $this->assertEquals($subsReq, $this->serializer->deserialize($json, DistributionListSubscribeReq::class, 'json'));
    }
}
