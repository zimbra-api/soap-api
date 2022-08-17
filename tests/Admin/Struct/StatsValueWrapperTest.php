<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StatsValueWrapper.
 */
class StatsValueWrapperTest extends ZimbraTestCase
{
    public function testStatsValueWrapper()
    {
        $name1 = $this->faker->word;
        $name2 = $this->faker->word;

        $stat1 = new NamedElement($name1);
        $stat2 = new NamedElement($name2);

        $values = new StubStatsValueWrapper([$stat1]);
        $this->assertSame([$stat1], $values->getStats());

        $values = new StubStatsValueWrapper();
        $values->setStats([$stat1])
             ->addStat($stat2);
        $this->assertSame([$stat1, $stat2], $values->getStats());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:stat name="$name1" />
    <urn:stat name="$name2" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));
        $this->assertEquals($values, $this->serializer->deserialize($xml, StubStatsValueWrapper::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubStatsValueWrapper extends StatsValueWrapper
{
}
