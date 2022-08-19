<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\WeekDay;
use Zimbra\Mail\Struct\ByDayRule;
use Zimbra\Mail\Struct\WkDay;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ByDayRule.
 */
class ByDayRuleTest extends ZimbraTestCase
{
    public function testByDayRule()
    {
        $day = WeekDay::SUNDAY();
        $ordWk = $this->faker->numberBetween(1, 53);
        $wkday = new WkDay($day, $ordWk);

        $byday = new StubByDayRule([$wkday]);
        $this->assertSame([$wkday], $byday->getDays());

        $byday = new StubByDayRule();
        $byday->setDays([$wkday])
            ->addDay($wkday);
        $this->assertSame([$wkday, $wkday], $byday->getDays());
        $byday->setDays([$wkday]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:wkday day="SU" ordwk="$ordWk" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($byday, 'xml'));
        $this->assertEquals($byday, $this->serializer->deserialize($xml, StubByDayRule::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubByDayRule extends ByDayRule
{
}
