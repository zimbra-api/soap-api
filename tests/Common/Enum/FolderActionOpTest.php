<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\FolderActionOp;

/**
 * Testcase class for FolderActionOp.
 */
class FolderActionOpTest extends TestCase
{
    public function testFolderActionOp()
    {
        $values = [
            'READ'                    => 'read',
            'DELETE'                  => 'delete',
            'RENAME'                  => 'rename',
            'MOVE'                    => 'move',
            'TRASH'                   => 'trash',
            'IS_EMPTY'                => 'empty',
            'COLOR'                   => 'color',
            'GRANT'                   => 'grant',
            'NOT_GRANT'               => '!grant',
            'REVOKE_ORPHAN_GRANTS'    => 'revokeorphangrants',
            'URL'                     => 'url',
            'IMPORT'                  => 'import',
            'SYNC'                    => 'sync',
            'FB'                      => 'fb',
            'CHECK'                   => 'check',
            'NOT_CHECK'               => '!check',
            'UPDATE'                  => 'update',
            'SYNCON'                  => 'syncon',
            'NOT_SYNCON'              => '!syncon',
            'RETENTION_POLICY'        => 'retentionpolicy',
            'DISABLE_ACTIVE_SYNC'     => 'disableactivesync',
            'NOT_DISABLE_ACTIVE_SYNC' => '!disableactivesync',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(FolderActionOp::from($value)->name, $name);
            $this->assertSame(FolderActionOp::from($value)->value, $value);
        }
    }
}
