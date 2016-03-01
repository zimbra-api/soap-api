<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerListEntry;
use Zimbra\Voice\Struct\FeatureWithCallerList;

/**
 * Testcase class for FeatureWithCallerList.
 */
class FeatureWithCallerListTest extends ZimbraStructTestCase
{
    public function testFeatureWithCallerList()
    {
        $pn = $this->faker->word;
        $phone = new CallerListEntry($pn, true);
        $featureWithCallerList = new FeatureWithCallerList(true, false, [$phone]);
        $this->assertInstanceOf('\Zimbra\Voice\Struct\CallFeatureInfo', $featureWithCallerList);
        $this->assertSame([$phone], $featureWithCallerList->getPhones()->all());
        $featureWithCallerList->addPhone($phone);
        $this->assertSame([$phone, $phone], $featureWithCallerList->getPhones()->all());
    }
}
