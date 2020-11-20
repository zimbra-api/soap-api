<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirSelector.
 */
class CheckDirSelectorTest extends ZimbraStructTestCase
{
    public function testCheckDirSelector()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, FALSE);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isCreate());

        $dir = new CheckDirSelector('', FALSE);
        $dir->setPath($path)
            ->setCreate(TRUE);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<directory path="' . $path . '" create="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dir, 'xml'));
        $this->assertEquals($dir, $this->serializer->deserialize($xml, CheckDirSelector::class, 'xml'));

        $json = json_encode([
            'path' => $path,
            'create' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dir, 'json'));
        $this->assertEquals($dir, $this->serializer->deserialize($json, CheckDirSelector::class, 'json'));
    }
}
