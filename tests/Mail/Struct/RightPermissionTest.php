<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RightPermission;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightPermission.
 */
class RightPermissionTest extends ZimbraTestCase
{
    public function testRightPermission()
    {
        $rightName = $this->faker->word;

        $right = new RightPermission(FALSE, $rightName);
        $this->assertSame($rightName, $right->getRightName());
        $this->assertFalse($right->getAllow());

        $right = new RightPermission(FALSE);
        $right->setRightName($rightName)
            ->setAllow(TRUE);
        $this->assertSame($rightName, $right->getRightName());
        $this->assertTrue($right->getAllow());

        $xml = <<<EOT
<?xml version="1.0"?>
<result allow="true">$rightName</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, RightPermission::class, 'xml'));
    }
}
