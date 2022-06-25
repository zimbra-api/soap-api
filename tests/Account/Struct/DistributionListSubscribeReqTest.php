<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListSubscribeReq.
 */
class DistributionListSubscribeReqTest extends ZimbraTestCase
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

        $op = DLSubscribeOp::SUBSCRIBE()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result op="$op" bccOwners="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($subsReq, 'xml'));
        $this->assertEquals($subsReq, $this->serializer->deserialize($xml, DistributionListSubscribeReq::class, 'xml'));
    }
}
