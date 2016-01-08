<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\InviteTest;

/**
 * Testcase class for InviteTest.
 */
class InviteTestTest extends ZimbraMailTestCase
{
    public function testInviteTest()
    {
        $index = mt_rand(1, 10);
        $method1 = $this->faker->word;
        $method2 = $this->faker->word;

        $inviteTest = new InviteTest(
            $index, [$method1], true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $inviteTest);
        $this->assertSame([$method1], $inviteTest->getMethods()->all());
        $inviteTest->addMethod($method2);
        $this->assertSame([$method1, $method2], $inviteTest->getMethods()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<inviteTest index="' . $index . '" negative="true">'
                .'<method>' . $method1 . '</method>'
                .'<method>' . $method2 . '</method>'
            .'</inviteTest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inviteTest);

        $array = array(
            'inviteTest' => array(
                'index' => $index,
                'negative' => true,
                'method' => array(
                    $method1,
                    $method2,
                ),
            ),
        );
        $this->assertEquals($array, $inviteTest->toArray());
    }
}
