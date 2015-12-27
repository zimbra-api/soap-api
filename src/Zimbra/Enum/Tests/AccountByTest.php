<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for AccountBy.
 */
class AccountByTest extends PHPUnit_Framework_TestCase
{
    public function testAccountBy()
    {
        $values = [
            'ADMIN_NAME'        => 'adminName',
            'APP_ADMIN_NAME'    => 'appAdminName',
            'ID'                => 'id',
            'FOREIGN_PRINCIPAL' => 'foreignPrincipal',
            'NAME'              => 'name',
            'KRB5_PRINCIPAL'    => 'krb5Principal',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AccountBy::$enum()->value(), $value);
        }
    }
}
