<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DiffDocumentVersionSpec;

/**
 * Testcase class for DiffDocumentVersionSpec.
 */
class DiffDocumentVersionSpecTest extends ZimbraMailTestCase
{
    public function testDiffDocumentVersionSpec()
    {
        $id = $this->faker->word;
        $v1 = mt_rand(1, 10);
        $v2 = mt_rand(1, 10);

        $doc = new DiffDocumentVersionSpec($id, $v1, $v2);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($v1, $doc->getVersion1());
        $this->assertSame($v2, $doc->getVersion2());

        $doc->setId($id)
            ->setVersion1($v1)
            ->setVersion2($v2);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($v1, $doc->getVersion1());
        $this->assertSame($v2, $doc->getVersion2());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<doc id="' . $id . '" v1="' . $v1 . '" v2="' . $v2 . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => $id,
                'v1' => $v1,
                'v2' => $v2,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }
}
