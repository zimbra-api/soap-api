<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerListEntry;
use Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature;

/**
 * Testcase class for SelectiveCallAcceptanceFeature.
 */
class SelectiveCallAcceptanceFeatureTest extends ZimbraStructTestCase
{
    public function testSelectiveCallAcceptanceFeature()
    {
        $pn = $this->faker->word;
        $phone = new CallerListEntry($pn, true);
        $selectivecallacceptance = new SelectiveCallAcceptanceFeature(
            true, false, [$phone]
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallacceptance);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance s="true" a="false">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallacceptance>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = [
            'selectivecallacceptance' => [
                's' => true,
                'a' => false,
                'phone' => [
                    [
                        'pn' => $pn,
                        'a' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }
}
