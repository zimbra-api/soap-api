<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\PurgeRevisionSpec;

/**
 * Testcase class for PurgeRevisionSpec.
 */
class PurgeRevisionSpecTest extends ZimbraMailTestCase
{
    public function testPurgeRevisionSpec()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 10);
        $revision = new PurgeRevisionSpec(
            $id, $ver, true
        );
        $this->assertSame($id, $revision->getId());
        $this->assertSame($ver, $revision->getVersion());
        $this->assertTrue($revision->getIncludeOlderRevisions());

        $revision = new PurgeRevisionSpec('', 0, false);
        $revision->setId($id)
                 ->setVersion($ver)
                 ->setIncludeOlderRevisions(true);
        $this->assertSame($id, $revision->getId());
        $this->assertSame($ver, $revision->getVersion());
        $this->assertTrue($revision->getIncludeOlderRevisions());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<revision id="' . $id . '" ver="' . $ver . '" includeOlderRevisions="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $revision);

        $array = array(
            'revision' => array(
                'id' => $id,
                'ver' => $ver,
                'includeOlderRevisions' => true,
            )
        );
        $this->assertEquals($array, $revision->toArray());
    }
}
