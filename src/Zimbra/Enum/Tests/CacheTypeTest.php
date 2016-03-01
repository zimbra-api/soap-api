<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CacheType;

/**
 * Testcase class for CacheType.
 */
class CacheTypeTest extends PHPUnit_Framework_TestCase
{
    public function testCacheType()
    {
        $values = [
            'SKIN'    => 'skin',
            'LOCALE'  => 'locale',
            'ACCOUNT' => 'account',
            'COS'     => 'cos',
            'DOMAIN'  => 'domain',
            'SERVER'  => 'server',
            'ZIMLET'  => 'zimlet',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CacheType::$enum()->value(), $value);
        }
    }
}
