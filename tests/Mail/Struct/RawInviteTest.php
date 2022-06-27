<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RawInvite;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RawInvite.
 */
class RawInviteTest extends ZimbraTestCase
{
    public function testRawInvite()
    {
        $uid = $this->faker->uuid;
        $summary = $this->faker->text;
        $content = $this->faker->text;

        $invite = new RawInvite($uid, $summary, $content);
        $this->assertSame($uid, $invite->getUid());
        $this->assertSame($summary, $invite->getSummary());
        $this->assertSame($content, $invite->getContent());

        $invite = new RawInvite();
        $invite->setUid($uid)
            ->setSummary($summary)
            ->setContent($content);
        $this->assertSame($uid, $invite->getUid());
        $this->assertSame($summary, $invite->getSummary());
        $this->assertSame($content, $invite->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result uid="$uid" summary="$summary">$content</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($invite, 'xml'));
        $this->assertEquals($invite, $this->serializer->deserialize($xml, RawInvite::class, 'xml'));
    }
}
