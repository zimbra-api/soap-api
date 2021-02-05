<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $constraint = new ConstraintInfo($min, $max, [$value1]);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value1], $constraint->getValues());

        $constraint = new ConstraintInfo();
        $constraint->setMin($min)
            ->setMax($max)
            ->setValues([$value1])
            ->addValue($value2);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value1, $value2], $constraint->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<constraint>
    <min>$min</min>
    <max>$max</max>
    <values>
        <v>$value1</v>
        <v>$value2</v>
    </values>
</constraint>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($constraint, 'xml'));
        $this->assertEquals($constraint, $this->serializer->deserialize($xml, ConstraintInfo::class, 'xml'));

        $json = json_encode([
            'min' => [
                '_content' => $min,
            ],
            'max' => [
                '_content' => $max,
            ],
            'values' => [
                'v' => [
                    [
                        '_content' => $value1,
                    ],
                    [
                        '_content' => $value2,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($constraint, 'json'));
        $this->assertEquals($constraint, $this->serializer->deserialize($json, ConstraintInfo::class, 'json'));
    }
}