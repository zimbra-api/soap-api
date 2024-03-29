<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CompletedTestInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CompletedTestInfo.
 */
class CompletedTestInfoTest extends ZimbraTestCase
{
    public function testCompletedTestInfo()
    {
        $name = $this->faker->word;
        $execSeconds = time();
        $className = $this->faker->word;

        $completed = new CompletedTestInfo($name, $execSeconds, $className);
        $this->assertSame($name, $completed->getName());
        $this->assertSame($execSeconds, $completed->getExecSeconds());
        $this->assertSame($className, $completed->getClassName());

        $completed = new CompletedTestInfo();
        $completed->setName($name)
            ->setExecSeconds($execSeconds)
            ->setClassName($className);
        $this->assertSame($name, $completed->getName());
        $this->assertSame($execSeconds, $completed->getExecSeconds());
        $this->assertSame($className, $completed->getClassName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" execSeconds="$execSeconds" class="$className"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($completed, 'xml'));
        $this->assertEquals($completed, $this->serializer->deserialize($xml, CompletedTestInfo::class, 'xml'));
    }
}
