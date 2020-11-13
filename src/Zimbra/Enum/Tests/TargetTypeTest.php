<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\TargetType;

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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(TargetType::$enum()->getValue(), $value);
        }
    }
}
