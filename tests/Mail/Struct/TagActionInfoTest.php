<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\TagActionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TagActionInfo.
 */
class TagActionInfoTest extends ZimbraTestCase
{
    public function testTagActionInfo()
    {
        $successes = $this->faker->uuid;
        $successNames = $this->faker->word;
        $operation = $this->faker->word;

        $action = new TagActionInfo(
            $successes, $successNames, $operation
        );
        $this->assertSame($successes, $action->getSuccesses());
        $this->assertSame($successNames, $action->getSuccessNames());
        $this->assertSame($operation, $action->getOperation());

        $action = new TagActionInfo();
        $action->setSuccesses($successes)
            ->setSuccessNames($successNames)
            ->setOperation($operation);
        $this->assertSame($successes, $action->getSuccesses());
        $this->assertSame($successNames, $action->getSuccessNames());
        $this->assertSame($operation, $action->getOperation());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$successes" tn="$successNames" op="$operation" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, TagActionInfo::class, 'xml'));
    }
}
