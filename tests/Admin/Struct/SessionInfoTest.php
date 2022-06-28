<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SessionInfo.
 */
class SessionInfoTest extends ZimbraTestCase
{
    public function testSessionInfo()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $foo = $this->faker->word;
        $bar = $this->faker->word;
        $attrs = [
            'foo' => $foo,
            'bar' => $bar,
        ];

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );
        $this->assertSame($sessionId, $session->getSessionId());
        $this->assertSame($createdDate, $session->getCreatedDate());
        $this->assertSame($lastAccessedDate, $session->getLastAccessedDate());
        $this->assertSame($zimbraId, $session->getZimbraId());
        $this->assertSame($name, $session->getName());

        $session = new SessionInfo();
        $session->setSessionId($sessionId)
            ->setCreatedDate($createdDate)
            ->setLastAccessedDate($lastAccessedDate)
            ->setZimbraId($zimbraId)
            ->setName($name)
            ->setExtraAttributes($attrs);
        $this->assertSame($sessionId, $session->getSessionId());
        $this->assertSame($createdDate, $session->getCreatedDate());
        $this->assertSame($lastAccessedDate, $session->getLastAccessedDate());
        $this->assertSame($zimbraId, $session->getZimbraId());
        $this->assertSame($name, $session->getName());
        $this->assertSame($attrs, $session->getExtraAttributes());

        $xml = <<<EOT
<?xml version="1.0"?>
<result zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" foo="$foo" bar="$bar" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));


        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );
        $this->assertEquals($session, $this->serializer->deserialize($xml, SessionInfo::class, 'xml'));
    }
}
