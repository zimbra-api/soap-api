<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\NotifyAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NotifyAction.
 */
class NotifyActionTest extends ZimbraTestCase
{
    public function testNotifyAction()
    {
        $index = mt_rand(1, 99);
        $address = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = mt_rand(1, 99);
        $content = $this->faker->word;
        $origHeaders = $this->faker->word;

        $action = new StubNotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $this->assertSame($address, $action->getAddress());
        $this->assertSame($subject, $action->getSubject());
        $this->assertSame($maxBodySize, $action->getMaxBodySize());
        $this->assertSame($content, $action->getContent());
        $this->assertSame($origHeaders, $action->getOrigHeaders());

        $action = new StubNotifyAction($index);
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubNotifyAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubNotifyAction extends NotifyAction
{
}
