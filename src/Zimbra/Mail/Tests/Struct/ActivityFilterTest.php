<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ActivityFilter;

/**
 * Testcase class for ActivityFilter.
 */
class ActivityFilterTest extends ZimbraMailTestCase
{
    public function testActivityFilter()
    {
        $account = $this->faker->word;
        $ops = $this->faker->word;
        $sessionId = $this->faker->uuid;

        $filter = new ActivityFilter(
            $account, $ops, $sessionId
        );
        $this->assertSame($account, $filter->getAccount());
        $this->assertSame($ops, $filter->getOps());
        $this->assertSame($sessionId, $filter->getSessionId());

        $filter->setAccount($account)
               ->setOps($ops)
               ->setSessionId($sessionId);
        $this->assertSame($account, $filter->getAccount());
        $this->assertSame($ops, $filter->getOps());
        $this->assertSame($sessionId, $filter->getSessionId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<filter account="' . $account . '" op="' . $ops . '" session="' . $sessionId . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'filter' => array(
                'account' => $account,
                'op' => $ops,
                'session' => $sessionId,
            ),
        );
        $this->assertEquals($array, $filter->toArray());
    }
}
