<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NotifyAction;

/**
 * Testcase class for NotifyAction.
 */
class NotifyActionTest extends ZimbraMailTestCase
{
    public function testNotifyAction()
    {
        $index = mt_rand(1, 10);
        $maxBodySize = mt_rand(1, 10);
        $content = $this->faker->word;
        $a = $this->faker->word;
        $su = $this->faker->word;
        $origHeaders = $this->faker->word;

        $action = new NotifyAction(
            $index, $content, $a, $su, $maxBodySize, $origHeaders
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $action);
        $this->assertSame($content, $action->getContent());
        $this->assertSame($a, $action->getAddress());
        $this->assertSame($su, $action->getSubject());
        $this->assertSame($maxBodySize, $action->getMaxBodySize());
        $this->assertSame($origHeaders, $action->getOrigHeaders());

        $action = new NotifyAction($index);
        $action->setContent($content)
               ->setAddress($a)
               ->setSubject($su)
               ->setMaxBodySize($maxBodySize)
               ->setOrigHeaders($origHeaders);
        $this->assertSame($content, $action->getContent());
        $this->assertSame($a, $action->getAddress());
        $this->assertSame($su, $action->getSubject());
        $this->assertSame($maxBodySize, $action->getMaxBodySize());
        $this->assertSame($origHeaders, $action->getOrigHeaders());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionNotify index="' . $index . '" a="' . $a . '" su="' . $su . '" maxBodySize="' . $maxBodySize . '" origHeaders="' . $origHeaders . '">'
                .'<content>' . $content . '</content>'
            .'</actionNotify>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'actionNotify' => array(
                'index' => $index,
                'content' => $content,
                'a' => $a,
                'su' => $su,
                'maxBodySize' => $maxBodySize,
                'origHeaders' => $origHeaders,
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
