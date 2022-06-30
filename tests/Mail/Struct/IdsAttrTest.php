<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdsAttr.
 */
class IdsAttrTest extends ZimbraTestCase
{
    public function testIdsAttr()
    {
        $ids = $this->faker->word;

        $attr = new IdsAttr($ids);
        $this->assertSame($ids, $attr->getIds());

        $attr = new IdsAttr();
        $attr->setIds($ids);
        $this->assertSame($ids, $attr->getIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result ids="$ids" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, IdsAttr::class, 'xml'));
    }
}
