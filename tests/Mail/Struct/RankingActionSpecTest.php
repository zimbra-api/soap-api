<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\RankingActionOp;
use Zimbra\Mail\Struct\RankingActionSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RankingActionSpec.
 */
class RankingActionSpecTest extends ZimbraTestCase
{
    public function testRankingActionSpec()
    {
        $operation = RankingActionOp::RESET();
        $email = $this->faker->email;

        $action = new RankingActionSpec(
            $operation, $email
        );
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($email, $action->getEmail());

        $action = new RankingActionSpec();
        $action->setOperation($operation)
            ->setEmail($email);
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($email, $action->getEmail());

        $xml = <<<EOT
<?xml version="1.0"?>
<result op="$operation" email="$email" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RankingActionSpec::class, 'xml'));
    }
}
