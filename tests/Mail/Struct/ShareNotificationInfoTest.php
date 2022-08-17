<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\Grantor;
use Zimbra\Mail\Struct\LinkInfo;
use Zimbra\Mail\Struct\ShareNotificationInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ShareNotificationInfo.
 */
class ShareNotificationInfoTest extends ZimbraTestCase
{
    public function testShareNotificationInfo()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $date = $this->faker->unixTime;
        $status = $this->faker->word;
        $email = $this->faker->email;
        $name = $this->faker->name;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;

        $grantor = new Grantor($id, $email, $name);
        $link = new LinkInfo(
            $id, $uuid, $name, $defaultView, $rights
        );

        $share = new StubShareNotificationInfo(
            $status, $id, $date, $grantor, $link
        );
        $this->assertSame($status, $share->getStatus());
        $this->assertSame($id, $share->getId());
        $this->assertSame($date, $share->getDate());
        $this->assertSame($grantor, $share->getGrantor());
        $this->assertSame($link, $share->getLink());

        $share = new StubShareNotificationInfo();
        $share->setId($id)
            ->setStatus($status)
            ->setDate($date)
            ->setGrantor($grantor)
            ->setLink($link);
        $this->assertSame($status, $share->getStatus());
        $this->assertSame($id, $share->getId());
        $this->assertSame($date, $share->getDate());
        $this->assertSame($grantor, $share->getGrantor());
        $this->assertSame($link, $share->getLink());

        $xml = <<<EOT
<?xml version="1.0"?>
<result status="$status" id="$id" d="$date" xmlns:urn="urn:zimbraMail">
    <urn:grantor id="$id" email="$email" name="$name" />
    <urn:link id="$id" uuid="$uuid" name="$name" view="$defaultView" perm="$rights" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($share, 'xml'));
        $this->assertEquals($share, $this->serializer->deserialize($xml, StubShareNotificationInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubShareNotificationInfo extends ShareNotificationInfo
{
}
