<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\IdVersion;

/**
 * Testcase class for IdVersion.
 */
class IdVersionTest extends ZimbraMailTestCase
{
    public function testIdVersion()
    {
        $id = $this->faker->word;
        $ver = mt_rand(1, 10);
        $doc = new IdVersion(
            $id, $ver
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());

        $doc->setId($id)
            ->setVersion($ver);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<doc id="' . $id . '" ver="' . $ver . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => $id,
                'ver' => $ver,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }
}
