<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CancelRuleInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CancelRuleInfo.
 */
class CancelRuleInfoTest extends ZimbraTestCase
{
    public function testCancelRuleInfo()
    {
        $recurrenceRangeType = mt_rand(1, 3);
        $recurrenceId = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurIdZ = $this->faker->date;

        $cancel = new CancelRuleInfo($recurrenceRangeType, $recurrenceId, $timezone, $recurIdZ);

        $xml = <<<EOT
<?xml version="1.0"?>
<result rangeType="$recurrenceRangeType" recurId="$recurrenceId" tz="$timezone" ridZ="$recurIdZ" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cancel, 'xml'));
        $this->assertEquals($cancel, $this->serializer->deserialize($xml, CancelRuleInfo::class, 'xml'));
    }
}
