<?php

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
        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::UNSUBSCRIBE()->value(), $value, false);
        $this->assertSame(DLSubscribeOp::UNSUBSCRIBE()->value(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertFalse($subsReq->getBccOwners());

        $subsReq = new DistributionListSubscribeReq('');
        $subsReq->setOp(DLSubscribeOp::SUBSCRIBE()->value())
                ->setValue($value)
                ->setBccOwners(true);
        $this->assertSame(DLSubscribeOp::SUBSCRIBE()->value(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertTrue($subsReq->getBccOwners());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($subsReq, 'xml'));

        $subsReq = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\DistributionListSubscribeReq', 'xml');
        $this->assertSame(DLSubscribeOp::SUBSCRIBE()->value(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertTrue($subsReq->getBccOwners());
    }
}
