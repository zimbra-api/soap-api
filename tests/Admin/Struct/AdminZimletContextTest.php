<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletContext;
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletContext.
 */
class AdminZimletContextTest extends ZimbraTestCase
{
    public function testAdminZimletContext()
    {
        $baseUrl = $this->faker->word;
        $priority = mt_rand(1, 10);

        $zimletContext = new AdminZimletContext(
            $baseUrl, ZimletPresence::MANDATORY(), $priority
        );
        $this->assertSame($baseUrl, $zimletContext->getZimletBaseUrl());
        $this->assertEquals(ZimletPresence::MANDATORY(), $zimletContext->getZimletPresence());
        $this->assertSame($priority, $zimletContext->getZimletPriority());

        $zimletContext = new AdminZimletContext();
        $zimletContext->setZimletBaseUrl($baseUrl)
            ->setZimletPresence(ZimletPresence::ENABLED())
            ->setZimletPriority($priority);
        $this->assertSame($baseUrl, $zimletContext->getZimletBaseUrl());
        $this->assertEquals(ZimletPresence::ENABLED(), $zimletContext->getZimletPresence());
        $this->assertSame($priority, $zimletContext->getZimletPriority());

        $presence = ZimletPresence::ENABLED()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result baseUrl="$baseUrl" priority="$priority" presence="$presence" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimletContext, 'xml'));
        $this->assertEquals($zimletContext, $this->serializer->deserialize($xml, AdminZimletContext::class, 'xml'));
    }
}
