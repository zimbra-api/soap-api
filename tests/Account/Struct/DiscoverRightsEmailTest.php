<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\DiscoverRightsEmail;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiscoverRightsEmail.
 */
class DiscoverRightsEmailTest extends ZimbraTestCase
{
    public function testDiscoverRightsEmail()
    {
        $addr = $this->faker->word;
        $email = new DiscoverRightsEmail($addr);
        $this->assertSame($addr, $email->getAddr());

        $email = new DiscoverRightsEmail('');
        $email->setAddr($addr);
        $this->assertSame($addr, $email->getAddr());

        $xml = <<<EOT
<?xml version="1.0"?>
<result addr="$addr" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($email, 'xml'));
        $this->assertEquals($email, $this->serializer->deserialize($xml, DiscoverRightsEmail::class, 'xml'));
    }
}
