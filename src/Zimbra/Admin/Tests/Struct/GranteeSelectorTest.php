<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GranteeSelector.
 */
class GranteeSelectorTest extends ZimbraStructTestCase
{
    public function testGranteeSelector()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $grantee = new GranteeSelector(
            $value, GranteeType::ALL()->value(), GranteeBy::NAME()->value(), $secret, false
        );
        $this->assertSame(GranteeType::ALL()->value(), $grantee->getType());
        $this->assertSame(GranteeBy::NAME()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertFalse($grantee->getAll());

        $grantee = new GranteeSelector();
        $grantee->setValue($value)
                ->setType(GranteeType::USR()->value())
                ->setBy(GranteeBy::ID()->value())
                ->setSecret($secret)
                ->setAll(true);
        $this->assertSame(GranteeType::USR()->value(), $grantee->getType());
        $this->assertSame(GranteeBy::ID()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertTrue($grantee->getAll());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));

        $grantee = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\GranteeSelector', 'xml');
        $this->assertSame(GranteeType::USR()->value(), $grantee->getType());
        $this->assertSame(GranteeBy::ID()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertTrue($grantee->getAll());
    }
}
