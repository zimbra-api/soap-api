<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerListEntry;
use Zimbra\Voice\Struct\SelectiveCallRejectionFeature;

/**
 * Testcase class for SelectiveCallRejectionFeature.
 */
class SelectiveCallRejectionFeatureTest extends ZimbraStructTestCase
{
    public function testSelectiveCallRejectionFeature()
    {
        $pn = $this->faker->word;
        $phone = new CallerListEntry($pn, true);
        $selectivecallrejection = new SelectiveCallRejectionFeature(
            true, false, [$phone]
        );
        $this->assertInstanceOf('\Zimbra\Voice\Struct\FeatureWithCallerList', $selectivecallrejection);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection s="true" a="false">'
                .'<phone pn="' . $pn . '" a="true" />'
            .'</selectivecallrejection>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = [
            'selectivecallrejection' => [
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
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }
}
