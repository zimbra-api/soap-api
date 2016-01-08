<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;

/**
 * Testcase class for ListDocumentRevisionsSpec.
 */
class ListDocumentRevisionsSpecTest extends ZimbraMailTestCase
{
    public function testListDocumentRevisionsSpec()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 7);
        $count = mt_rand(1, 7);

        $doc = new ListDocumentRevisionsSpec(
            $id, $ver, $count
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());
        $this->assertSame($count, $doc->getCount());

        $doc->setId($id)
            ->setVersion($ver)
            ->setCount($count);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());
        $this->assertSame($count, $doc->getCount());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<doc id="' . $id . '" ver="' . $ver . '" count="' . $count . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => $id,
                'ver' => $ver,
                'count' => $count,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }
}
