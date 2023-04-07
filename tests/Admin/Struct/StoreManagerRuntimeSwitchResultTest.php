<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\StoreManagerRuntimeSwitchResult;
use Zimbra\Common\Enum\RuntimeSwitchStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StoreManagerRuntimeSwitchResult.
 */
class StoreManagerRuntimeSwitchResultTest extends ZimbraTestCase
{
    public function testStoreManagerRuntimeSwitchResult()
    {
        $message = $this->faker->word;

        $result = new StoreManagerRuntimeSwitchResult(RuntimeSwitchStatus::NO_OPERATION(), $message);
        $this->assertEquals(RuntimeSwitchStatus::NO_OPERATION(), $result->getStatus());
        $this->assertSame($message, $result->getMessage());

        $result = new StoreManagerRuntimeSwitchResult();
        $result->setStatus(RuntimeSwitchStatus::SUCCESS())
            ->setMessage($message);
        $this->assertEquals(RuntimeSwitchStatus::SUCCESS(), $result->getStatus());
        $this->assertSame($message, $result->getMessage());

        $status = RuntimeSwitchStatus::SUCCESS()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result status="$status" message="$message" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($result, 'xml'));
        $this->assertEquals($result, $this->serializer->deserialize($xml, StoreManagerRuntimeSwitchResult::class, 'xml'));
    }
}
