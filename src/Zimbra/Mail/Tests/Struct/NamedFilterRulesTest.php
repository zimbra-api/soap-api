<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NamedFilterRules;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for NamedFilterRules.
 */
class NamedFilterRulesTest extends ZimbraMailTestCase
{
    public function testNamedFilterRules()
    {
        $name1 = $this->faker->word;
        $name2 = $this->faker->word;
        $rule1 = new NamedElement($name1);
        $rule2 = new NamedElement($name2);

        $filterRules = new NamedFilterRules([$rule1]);

        $this->assertSame([$rule1], $filterRules->getFilterRules()->all());
        $filterRules->addFilterRule($rule2);
        $this->assertSame([$rule1, $rule2], $filterRules->getFilterRules()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<filterRules>'
                .'<filterRule name="' . $name1 . '" />'
                .'<filterRule name="' . $name2 . '" />'
            .'</filterRules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterRules);

        $array = array(
            'filterRules' => array(
                'filterRule' => array(
                    array('name' => $name1),
                    array('name' => $name2),
                ),
            ),
        );
        $this->assertEquals($array, $filterRules->toArray());
    }
}
