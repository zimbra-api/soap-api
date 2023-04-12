<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\TargetType;

/**
 * Testcase class for TargetType.
 */
class TargetTypeTest extends TestCase
{
    public function testTargetType()
    {
        $values = [
            'ACCOUNT'         => 'account',
            'CALRESOURCE'     => 'calresource',
            'COS'             => 'cos',
            'DL'              => 'dl',
            'GROUP'           => 'group',
            'DOMAIN'          => 'domain',
            'SERVER'          => 'server',
            'ALWAYSONCLUSTER' => 'alwaysoncluster',
            'UCSERVICE'       => 'ucservice',
            'XMPPCOMPONENT'   => 'xmppcomponent',
            'ZIMLET'          => 'zimlet',
            'CONFIG'          => 'config',
            'GLOBALTYPE'      => 'global',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(TargetType::from($value)->value, $value);
            $this->assertSame(TargetType::from($value)->name, $name);
        }
    }
}
