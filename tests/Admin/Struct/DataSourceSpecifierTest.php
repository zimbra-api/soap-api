<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\{Attr, DataSourceSpecifier};
use Zimbra\Common\Enum\DataSourceType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DataSourceSpecifier.
 */
class DataSourceSpecifierTest extends ZimbraTestCase
{
    public function testDataSourceSpecifier()
    {
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $ds = new StubDataSourceSpecifier(DataSourceType::IMAP(), $name);
        $this->assertEquals(DataSourceType::IMAP(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $attr = new Attr($key, $value);
        $ds = new StubDataSourceSpecifier();
        $ds->setType(DataSourceType::POP3())
           ->setName($name)
           ->addAttr($attr);
        $this->assertEquals(DataSourceType::POP3(), $ds->getType());
        $this->assertSame($name, $ds->getName());

        $type = DataSourceType::POP3()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, StubDataSourceSpecifier::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubDataSourceSpecifier extends DataSourceSpecifier
{
}
