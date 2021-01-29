<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for AccountBy.
 */
class AccountByTest extends TestCase
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
        foreach ($values as $enum => $value) {
            $this->assertSame(AccountBy::$enum()->getValue(), $value);
        }
    }
}
