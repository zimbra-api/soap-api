<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\LocaleInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LocaleInfo.
 */
class LocaleInfoTest extends ZimbraTestCase
{
    public function testLocaleInfo()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $localName = $this->faker->country;

        $locale = new LocaleInfo($id, $name, $localName);
        $this->assertSame($id, $locale->getId());
        $this->assertSame($name, $locale->getName());
        $this->assertSame($localName, $locale->getLocalName());

        $locale = new LocaleInfo();
        $locale->setId($id)
            ->setName($name)
            ->setLocalName($localName);
        $this->assertSame($id, $locale->getId());
        $this->assertSame($name, $locale->getName());
        $this->assertSame($localName, $locale->getLocalName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" localName="$localName" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($locale, 'xml'));
        $this->assertEquals($locale, $this->serializer->deserialize($xml, LocaleInfo::class, 'xml'));
    }
}
