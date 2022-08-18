<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ModifyGroupMemberOperation;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Mail\Struct\ModifyContactGroupMember;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyContactGroupMember.
 */
class ModifyContactGroupMemberTest extends ZimbraTestCase
{
    public function testModifyContactGroupMember()
    {
        $operation = ModifyGroupMemberOperation::RESET;

        $test = new ModifyContactGroupMember(
            $operation
        );
        $this->assertEquals($operation, $test->getOperation());
        $this->assertTrue($test instanceof NewContactGroupMember);

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="C" op="reset" value="" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ModifyContactGroupMember::class, 'xml'));
    }
}
