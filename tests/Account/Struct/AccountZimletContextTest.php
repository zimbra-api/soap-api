<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountZimletContext;
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountZimletContext.
 */
class AccountZimletContextTest extends ZimbraTestCase
{
    public function testAccountZimletContext()
    {
        $baseUrl = $this->faker->word;
        $priority = mt_rand(1, 10);

        $zimletContext = new AccountZimletContext(
            $baseUrl, ZimletPresence::MANDATORY, $priority
        );
        $this->assertSame($baseUrl, $zimletContext->getZimletBaseUrl());
        $this->assertEquals(ZimletPresence::MANDATORY, $zimletContext->getZimletPresence());
        $this->assertSame($priority, $zimletContext->getZimletPriority());

        $zimletContext = new AccountZimletContext();
        $zimletContext->setZimletBaseUrl($baseUrl)
            ->setZimletPresence(ZimletPresence::ENABLED)
            ->setZimletPriority($priority);
        $this->assertSame($baseUrl, $zimletContext->getZimletBaseUrl());
        $this->assertEquals(ZimletPresence::ENABLED, $zimletContext->getZimletPresence());
        $this->assertSame($priority, $zimletContext->getZimletPriority());

        $presence = ZimletPresence::ENABLED->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result baseUrl="$baseUrl" priority="$priority" presence="$presence" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimletContext, 'xml'));
        $this->assertEquals($zimletContext, $this->serializer->deserialize($xml, AccountZimletContext::class, 'xml'));
    }
}
