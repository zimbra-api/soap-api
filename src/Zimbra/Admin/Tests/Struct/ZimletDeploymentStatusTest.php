<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ZimletDeploymentStatus;
use Zimbra\Enum\ZimletDeployStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZimletDeploymentStatus.
 */
class ZimletDeploymentStatusTest extends ZimbraStructTestCase
{
    public function testZimletDeploymentStatus()
    {
        $server = $this->faker->word;
        $error = $this->faker->word;
        $progress = new ZimletDeploymentStatus($server, ZimletDeployStatus::SUCCEEDED(), $error);
        $this->assertSame($server, $progress->getServer());
        $this->assertEquals(ZimletDeployStatus::SUCCEEDED(), $progress->getStatus());
        $this->assertSame($error, $progress->getError());

        $progress = new ZimletDeploymentStatus('', ZimletDeployStatus::FAILED());
        $progress->setServer($server)
            ->setStatus(ZimletDeployStatus::SUCCEEDED())
            ->setError($error);
        $this->assertSame($server, $progress->getServer());
        $this->assertEquals(ZimletDeployStatus::SUCCEEDED(), $progress->getStatus());
        $this->assertSame($error, $progress->getError());

        $status = ZimletDeployStatus::SUCCEEDED()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<progress server="$server" status="$status" error="$error" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($progress, 'xml'));
        $this->assertEquals($progress, $this->serializer->deserialize($xml, ZimletDeploymentStatus::class, 'xml'));

        $json = json_encode([
            'server' => $server,
            'status' => $status,
            'error' => $error,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($progress, 'json'));
        $this->assertEquals($progress, $this->serializer->deserialize($json, ZimletDeploymentStatus::class, 'json'));
    }
}
