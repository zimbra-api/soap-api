<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\FreeBusyQueueProvider;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusyQueueProvider.
 */
class FreeBusyQueueProviderTest extends ZimbraTestCase
{
    public function testFreeBusyQueueProvider()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $account = new Id($id);

        $provider = new StubFreeBusyQueueProvider($name, [$account]);
        $this->assertSame($name, $provider->getName());
        $this->assertSame([$account], $provider->getAccounts());

        $provider = new StubFreeBusyQueueProvider();
        $provider->setName($name)
             ->setAccounts([$account]);
        $this->assertSame($name, $provider->getName());
        $this->assertSame([$account], $provider->getAccounts());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:account id="$id" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($provider, 'xml'));
        $this->assertEquals($provider, $this->serializer->deserialize($xml, StubFreeBusyQueueProvider::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubFreeBusyQueueProvider extends FreeBusyQueueProvider
{
}
