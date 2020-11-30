<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\NotifyAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for NotifyAction.
 */
class NotifyActionTest extends ZimbraStructTestCase
{
    public function testNotifyAction()
    {
        $index = mt_rand(1, 99);
        $address = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = mt_rand(1, 99);
        $content = $this->faker->word;
        $origHeaders = $this->faker->word;

        $action = new NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $this->assertSame($address, $action->getAddress());
        $this->assertSame($subject, $action->getSubject());
        $this->assertSame($maxBodySize, $action->getMaxBodySize());
        $this->assertSame($content, $action->getContent());
        $this->assertSame($origHeaders, $action->getOrigHeaders());

        $action = new NotifyAction($index);
        $action->setAddress($address)
            ->setSubject($subject)
            ->setMaxBodySize($maxBodySize)
            ->setContent($content)
            ->setOrigHeaders($origHeaders);
        $this->assertSame($address, $action->getAddress());
        $this->assertSame($subject, $action->getSubject());
        $this->assertSame($maxBodySize, $action->getMaxBodySize());
        $this->assertSame($content, $action->getContent());
        $this->assertSame($origHeaders, $action->getOrigHeaders());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionNotify index="' . $index . '" a="' . $address . '" su="' . $subject . '" maxBodySize="' . $maxBodySize . '" origHeaders="' . $origHeaders . '">'
                . '<content>' . $content . '</content>'
            . '</actionNotify>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, NotifyAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'a' => $address,
            'su' => $subject,
            'maxBodySize' => $maxBodySize,
            'content' => [
                '_content' => $content,
            ],
            'origHeaders' => $origHeaders,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, NotifyAction::class, 'json'));
    }
}
