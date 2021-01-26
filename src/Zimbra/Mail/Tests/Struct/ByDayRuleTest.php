<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Enum\WeekDay;
use Zimbra\Mail\Struct\ByDayRule;
use Zimbra\Mail\Struct\WkDay;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ByDayRule.
 */
class ByDayRuleTest extends ZimbraStructTestCase
{
    public function testByDayRule()
    {
        $day = WeekDay::SU();
        $ordWk = mt_rand(1, 53);
        $wkday = new WkDay($day, $ordWk);

        $byday = new ByDayRule([$wkday]);
        $this->assertSame([$wkday], $byday->getDays());

        $byday = new ByDayRule();
        $byday->setDays([$wkday])
            ->addDay($wkday);
        $this->assertSame([$wkday, $wkday], $byday->getDays());
        $byday->setDays([$wkday]);

        $xml = <<<EOT
<?xml version="1.0"?>
<byday>
    <wkday day="SU" ordwk="$ordWk" />
</byday>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($byday, 'xml'));
        $this->assertEquals($byday, $this->serializer->deserialize($xml, ByDayRule::class, 'xml'));

        $json = json_encode([
            'wkday' => [
                [
                    'day' => 'SU',
                    'ordwk' => $ordWk,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($byday, 'json'));
        $this->assertEquals($byday, $this->serializer->deserialize($json, ByDayRule::class, 'json'));
    }
}
