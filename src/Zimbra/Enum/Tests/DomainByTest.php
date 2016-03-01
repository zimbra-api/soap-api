<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for DomainBy.
 */
class DomainByTest extends PHPUnit_Framework_TestCase
{
    public function testDomainBy()
    {
        $values = [
            'ID'               => 'id',
            'NAME'             => 'name',
            'VIRTUAL_HOSTNAME' => 'virtualHostname',
            'KRB5_REALM'       => 'krb5Realm',
            'FOREIGN_NAME'     => 'foreignName',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DomainBy::$enum()->value(), $value);
        }
    }
}
