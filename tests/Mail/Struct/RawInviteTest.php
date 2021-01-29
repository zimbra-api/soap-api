<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RawInvite;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RawInvite.
 */
class RawInviteTest extends ZimbraStructTestCase
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
<invite uid="$uid" summary="$summary">$content</invite>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($invite, 'xml'));
        $this->assertEquals($invite, $this->serializer->deserialize($xml, RawInvite::class, 'xml'));

        $json = json_encode([
            'uid' => $uid,
            'summary' => $summary,
            '_content' => $content,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($invite, 'json'));
        $this->assertEquals($invite, $this->serializer->deserialize($json, RawInvite::class, 'json'));
    }
}
