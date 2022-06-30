<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalOrganizer.
 */
class CalOrganizerTest extends ZimbraTestCase
{
    public function testCalOrganizer()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $url = $this->faker->url;
        $displayName = $this->faker->name;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $xparam = new XParam($name, $value);

        $or = new StubCalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [$xparam]);
        $this->assertSame($address, $or->getAddress());
        $this->assertSame($url, $or->getUrl());
        $this->assertSame($displayName, $or->getDisplayName());
        $this->assertSame($sentBy, $or->getSentBy());
        $this->assertSame($dir, $or->getDir());
        $this->assertSame($language, $or->getLanguage());
        $this->assertSame([$xparam], $or->getXParams());

        $or = new StubCalOrganizer();
        $or->setAddress($address)
            ->setUrl($url)
            ->setDisplayName($displayName)
            ->setSentBy($sentBy)
            ->setDir($dir)
            ->setLanguage($language)
            ->setXParams([$xparam])
            ->addXParam($xparam);
        $this->assertSame($address, $or->getAddress());
        $this->assertSame($url, $or->getUrl());
        $this->assertSame($displayName, $or->getDisplayName());
        $this->assertSame($sentBy, $or->getSentBy());
        $this->assertSame($dir, $or->getDir());
        $this->assertSame($language, $or->getLanguage());
        $this->assertSame([$xparam, $xparam], $or->getXParams());
        $or->setXParams([$xparam]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language" xmlns:urn="urn:zimbraMail">
    <urn:xparam name="$name" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($or, 'xml'));
        $this->assertEquals($or, $this->serializer->deserialize($xml, StubCalOrganizer::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubCalOrganizer extends CalOrganizer
{
}
