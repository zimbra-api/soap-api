<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;

/**
 * Testcase class for GranteeSelector.
 */
class GranteeSelectorTest extends ZimbraAdminTestCase
{
    public function testGranteeSelector()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $grantee = new GranteeSelector(
            $value, GranteeType::ALL(), GranteeBy::NAME(), $secret, false
        );
        $this->assertSame('all', $grantee->getType()->value());
        $this->assertSame('name', $grantee->getBy()->value());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertFalse($grantee->getAll());

        $grantee->setType(GranteeType::USR())
                ->setBy(GranteeBy::ID())
                ->setSecret($secret)
                ->setAll(true);
        $this->assertSame('usr', $grantee->getType()->value());
        $this->assertSame('id', $grantee->getBy()->value());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertTrue($grantee->getAll());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = [
            'grantee' => [
                '_content' => $value,
                'type' => GranteeType::USR()->value(),
                'by' => GranteeBy::ID()->value(),
                'secret' => $secret,
                'all' => true,
            ],
        ];
        $this->assertEquals($array, $grantee->toArray());
    }
}
