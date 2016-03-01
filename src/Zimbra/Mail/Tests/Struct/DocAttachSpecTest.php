<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DocAttachSpec;

/**
 * Testcase class for DocAttachSpec.
 */
class DocAttachSpecTest extends ZimbraMailTestCase
{
    public function testDocAttachSpec()
    {
        $path = $this->faker->word;
        $id = $this->faker->word;
        $ver = mt_rand(1, 100);

        $doc = new DocAttachSpec($path, $id, $ver, true);
        $this->assertInstanceOf('Zimbra\Mail\Struct\AttachSpec', $doc);
        $this->assertSame($path, $doc->getPath());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());

        $doc->setPath($path)
            ->setId($id)
            ->setVersion($ver);
        $this->assertSame($path, $doc->getPath());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($ver, $doc->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<doc path="' . $path . '" id="' . $id . '" ver="' . $ver . '" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'path' => $path,
                'id' => $id,
                'ver' => $ver,
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }
}
