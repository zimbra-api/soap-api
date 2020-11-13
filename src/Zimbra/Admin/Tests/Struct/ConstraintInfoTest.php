<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConstraintInfo.
 */
class ConstraintInfoTest extends ZimbraStructTestCase
{
    public function testConstraintInfo()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new ConstraintInfo($max, $min, [$value1]);
        $this->assertSame($max, $constraint->getMin());
        $this->assertSame($min, $constraint->getMax());
        $this->assertSame([$value1], $constraint->getValues());

        $constraint = new ConstraintInfo();
        $constraint->setMin($min)
            ->setMax($max)
            ->setValues([$value1])
            ->addValue($value2);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value1, $value2], $constraint->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<constraint>'
                . '<min>' . $min . '</min>'
                . '<max>' . $max . '</max>'
                . '<values>'
                    . '<v>' . $value1 . '</v>'
                    . '<v>' . $value2 . '</v>'
                . '</values>'
            . '</constraint>';
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
        $this->assertSame($json, $this->serializer->serialize($constraint, 'json'));
        $this->assertEquals($constraint, $this->serializer->deserialize($json, ConstraintInfo::class, 'json'));
    }
}
