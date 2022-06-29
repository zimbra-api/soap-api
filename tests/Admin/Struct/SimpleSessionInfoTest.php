<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\SimpleSessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SimpleSessionInfo.
 */
class SimpleSessionInfoTest extends ZimbraTestCase
{
    public function testSimpleSessionInfo()
    {
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);

        $session = new SimpleSessionInfo(
            $zimbraId, $name, $sessionId, $createdDate, $lastAccessedDate
        );
        $this->assertSame($zimbraId, $session->getZimbraId());
        $this->assertSame($name, $session->getName());
        $this->assertSame($sessionId, $session->getSessionId());
        $this->assertSame($createdDate, $session->getCreatedDate());
        $this->assertSame($lastAccessedDate, $session->getLastAccessedDate());

        $session = new SimpleSessionInfo();
        $session->setSessionId($sessionId)
            ->setCreatedDate($createdDate)
            ->setLastAccessedDate($lastAccessedDate)
            ->setZimbraId($zimbraId)
            ->setName($name);
        $this->assertSame($zimbraId, $session->getZimbraId());
        $this->assertSame($name, $session->getName());
        $this->assertSame($sessionId, $session->getSessionId());
        $this->assertSame($createdDate, $session->getCreatedDate());
        $this->assertSame($lastAccessedDate, $session->getLastAccessedDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($xml, SimpleSessionInfo::class, 'xml'));
    }
}
