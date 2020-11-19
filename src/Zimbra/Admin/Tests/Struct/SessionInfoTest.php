<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Enum\VolumeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SessionInfo.
 */
class SessionInfoTest extends ZimbraStructTestCase
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

        $session = new SessionInfo('', 0, 0);
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<session '
                . 'zid="' . $zimbraId . '" '
                . 'name="' . $name . '" '
                . 'sid="' . $sessionId . '" '
                . 'cd="' . $createdDate . '" '
                . 'ld="' . $lastAccessedDate . '" '
                . 'foo="' . $foo . '" '
                . 'bar="' . $bar . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));

        $json = json_encode([
            'zid' => $zimbraId,
            'name' => $name,
            'sid' => $sessionId,
            'cd' => $createdDate,
            'ld' => $lastAccessedDate,
            'foo' => $foo,
            'bar' => $bar,
        ]);
        $this->assertSame($json, $this->serializer->serialize($session, 'json'));

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );
        $this->assertEquals($session, $this->serializer->deserialize($xml, SessionInfo::class, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($json, SessionInfo::class, 'json'));
    }
}
