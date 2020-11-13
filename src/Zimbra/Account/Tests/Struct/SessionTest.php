<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Session;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Session.
 */
class SessionTest extends ZimbraStructTestCase
{
    public function testProp()
    {
        $type = $this->faker->word;
        $id = $this->faker->uuid;

        $session = new Session($id, $type);
        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());

        $session = new Session('', '');
        $session->setType($type)
             ->setId($id)
             ->setValue($id);
        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<session type="' . $type . '" id="' . $id . '">'  .$id . '</session>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($xml, Session::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
            '_content' => $id,
        ]);
        $this->assertSame($json, $this->serializer->serialize($session, 'json'));
        $this->assertEquals($session, $this->serializer->deserialize($json, Session::class, 'json'));
    }
}
