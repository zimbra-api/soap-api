<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\OAuthConsumer;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for OAuthConsumer.
 */
class OAuthConsumerTest extends ZimbraTestCase
{
    public function testOAuthConsumer()
    {
        $accessToken = $this->faker->uuid;
        $approvedOn = $this->faker->text;
        $applicationName = $this->faker->name;
        $device = $this->faker->name;

        $consumer = new OAuthConsumer($accessToken, $approvedOn, $applicationName, $device);
        $this->assertSame($accessToken, $consumer->getAccessToken());
        $this->assertSame($approvedOn, $consumer->getApprovedOn());
        $this->assertSame($applicationName, $consumer->getApplicationName());
        $this->assertSame($device, $consumer->getDevice());

        $consumer = new OAuthConsumer();
        $consumer->setAccessToken($accessToken)
            ->setApprovedOn($approvedOn)
            ->setApplicationName($applicationName)
            ->setDevice($device);
        $this->assertSame($accessToken, $consumer->getAccessToken());
        $this->assertSame($approvedOn, $consumer->getApprovedOn());
        $this->assertSame($applicationName, $consumer->getApplicationName());
        $this->assertSame($device, $consumer->getDevice());

        $xml = <<<EOT
<?xml version="1.0"?>
<result accessToken="$accessToken" approvedOn="$approvedOn" appName="$applicationName" device="$device" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($consumer, 'xml'));
        $this->assertEquals($consumer, $this->serializer->deserialize($xml, OAuthConsumer::class, 'xml'));
    }
}
