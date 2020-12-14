<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\FreeBusyQueueProvider;
use Zimbra\Struct\Id;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FreeBusyQueueProvider.
 */
class FreeBusyQueueProviderTest extends ZimbraStructTestCase
{
    public function testFreeBusyQueueProvider()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $account = new Id($id);

        $provider = new FreeBusyQueueProvider($name, [$account]);
        $this->assertSame($name, $provider->getName());
        $this->assertSame([$account], $provider->getAccounts());

        $provider = new FreeBusyQueueProvider('');
        $provider->setName($name)
             ->setAccounts([$account])
             ->addAccount($account);
        $this->assertSame($name, $provider->getName());
        $this->assertSame([$account, $account], $provider->getAccounts());
        $provider->setAccounts([$account]);

        $xml = <<<EOT
<?xml version="1.0"?>
<provider name="$name">
    <account id="$id" />
</provider>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($provider, 'xml'));
        $this->assertEquals($provider, $this->serializer->deserialize($xml, FreeBusyQueueProvider::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'account' => [
                [
                    'id' => $id,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($provider, 'json'));
        $this->assertEquals($provider, $this->serializer->deserialize($json, FreeBusyQueueProvider::class, 'json'));
    }
}
