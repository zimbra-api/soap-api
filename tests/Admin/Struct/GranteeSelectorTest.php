<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GranteeSelector.
 */
class GranteeSelectorTest extends ZimbraTestCase
{
    public function testGranteeSelector()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $grantee = new GranteeSelector(
            $value, GranteeType::ALL(), GranteeBy::NAME(), $secret, FALSE
        );
        $this->assertEquals(GranteeType::ALL(), $grantee->getType());
        $this->assertEquals(GranteeBy::NAME(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertFalse($grantee->getAll());

        $grantee = new GranteeSelector();
        $grantee->setValue($value)
                ->setType(GranteeType::USR())
                ->setBy(GranteeBy::ID())
                ->setSecret($secret)
                ->setAll(TRUE);
        $this->assertEquals(GranteeType::USR(), $grantee->getType());
        $this->assertEquals(GranteeBy::ID(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertTrue($grantee->getAll());

        $type = GranteeType::USR()->getValue();
        $by = GranteeBy::ID()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" by="$by" secret="$secret" all="true">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeSelector::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'by' => $by,
            '_content' => $value,
            'secret' => $secret,
            'all' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeSelector::class, 'json'));
    }
}
