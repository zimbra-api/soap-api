<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StatsSpec.
 */
class StatsSpecTest extends ZimbraTestCase
{
    public function testStatsSpec()
    {
        $name = $this->faker->word;
        $limit = $this->faker->word;

        $stat = new NamedElement($name);
        $values = new StatsValueWrapper([$stat]);

        $stats = new StubStatsSpec($values, $name, $limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $stats = new StubStatsSpec(new StatsValueWrapper());
        $stats->setValues($values)
              ->setName($name)
              ->setLimit($limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" limit="$limit" xmlns:urn="urn:zimbraAdmin">
    <urn:values>
        <urn:stat name="$name" />
    </urn:values>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, StubStatsSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubStatsSpec extends StatsSpec
{
}
