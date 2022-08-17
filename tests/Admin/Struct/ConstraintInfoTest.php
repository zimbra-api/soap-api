<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConstraintInfo.
 */
class ConstraintInfoTest extends ZimbraTestCase
{
    public function testConstraintInfo()
    {
        $value1 = $this->faker->text;
        $value2 = $this->faker->text;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new StubConstraintInfo($min, $max, [$value1]);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value1], $constraint->getValues());

        $constraint = new StubConstraintInfo();
        $constraint->setMin($min)
            ->setMax($max)
            ->setValues([$value1])
            ->addValue($value2);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value1, $value2], $constraint->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:min>$min</urn:min>
    <urn:max>$max</urn:max>
    <urn:values>
        <urn:v>$value1</urn:v>
        <urn:v>$value2</urn:v>
    </urn:values>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($constraint, 'xml'));
        $this->assertEquals($constraint, $this->serializer->deserialize($xml, StubConstraintInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubConstraintInfo extends ConstraintInfo
{
}
