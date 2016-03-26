<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\TargetType;

/**
 * Testcase class for TargetType.
 */
class TargetTypeTest extends PHPUnit_Framework_TestCase
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
            $this->assertSame(TargetType::$enum()->value(), $value);
        }
    }
}
