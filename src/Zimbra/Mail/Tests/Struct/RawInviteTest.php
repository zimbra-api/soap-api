<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\RawInvite;

/**
 * Testcase class for RawInvite.
 */
class RawInviteTest extends ZimbraMailTestCase
{
    public function testRawInvite()
    {
        $uid = $this->faker->uuid;
        $value = $this->faker->word;
        $summary = $this->faker->word;

        $content = new RawInvite($uid, $value, $summary);
        $this->assertSame($uid, $content->getUid());
        $this->assertSame($summary, $content->getSummary());

        $content = new RawInvite('', $value);
        $content->setUid($uid)
                ->setSummary($summary);
        $this->assertSame($uid, $content->getUid());
        $this->assertSame($summary, $content->getSummary());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<content uid="' . $uid . '" summary="' . $summary . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_content' => $value,
                'uid' => $uid,
                'summary' => $summary,
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }
}
