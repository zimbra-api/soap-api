<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\XParam;

/**
 * Testcase class for CalOrganizer.
 */
class CalOrganizerTest extends ZimbraMailTestCase
{
    public function testCalOrganizer()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $name2 = $this->faker->word;
        $value2 = $this->faker->word;

        $xparam1 = new XParam($name1, $value1);
        $xparam2 = new XParam($name2, $value2);

        $address = $this->faker->word;
        $url = $this->faker->word;
        $displayName = $this->faker->word;
        $sentBy = $this->faker->word;
        $dir = $this->faker->word;
        $lang = $this->faker->word;

        $or = new CalOrganizer(
            $address, $url, $displayName, $sentBy, $dir, $lang, [$xparam1]
        );

        $this->assertSame([$xparam1], $or->getXParams()->all());
        $this->assertSame($address, $or->getAddress());
        $this->assertSame($url, $or->getUrl());
        $this->assertSame($displayName, $or->getDisplayName());
        $this->assertSame($sentBy, $or->getSentBy());
        $this->assertSame($dir, $or->getDir());
        $this->assertSame($lang, $or->getLanguage());

        $or->addXParam($xparam2);
        $this->assertSame([$xparam1, $xparam2], $or->getXParams()->all());
        $or->setAddress($address)
           ->setUrl($url)
           ->setDisplayName($displayName)
           ->setSentBy($sentBy)
           ->setDir($dir)
           ->setLanguage($lang);
        $this->assertSame($address, $or->getAddress());
        $this->assertSame($url, $or->getUrl());
        $this->assertSame($displayName, $or->getDisplayName());
        $this->assertSame($sentBy, $or->getSentBy());
        $this->assertSame($dir, $or->getDir());
        $this->assertSame($lang, $or->getLanguage());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<or a="' . $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang . '">'
                .'<xparam name="' . $name1 . '" value="' . $value1 . '" />'
                .'<xparam name="' . $name2 . '" value="' . $value2 . '" />'
            .'</or>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $or);

        $array = array(
            'or' => array(
                'a' => $address,
                'url' => $url,
                'd' => $displayName,
                'sentBy' => $sentBy,
                'dir' => $dir,
                'lang' => $lang,
                'xparam' => array(
                    array(
                        'name' => $name1,
                        'value' => $value1,
                    ),
                    array(
                        'name' => $name2,
                        'value' => $value2,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $or->toArray());
    }
}
