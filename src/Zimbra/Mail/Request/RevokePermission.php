<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\AccountACEinfo;

/**
 * RevokePermission request class
 * Revoke account level permissions 
 * RevokePermissionResponse returns permissions that are successfully revoked.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokePermission extends Base
{
    /**
     * Specify Access Control Entries (ACEs)
     * @var TypedSequence<AccountACEinfo>
     */
    private $_ace;

    /**
     * Constructor method for RevokePermission
     * @param  array $ace;
     * @return self
     */
    public function __construct(array $ace = array())
    {
        parent::__construct();
        $this->_ace = new TypedSequence('Zimbra\Mail\Struct\AccountACEinfo', $ace);

        $this->addHook(function($sender)
        {
            if(count($sender->ace()))
            {
                $sender->child('ace', $sender->ace()->all());
            }
        });
    }

    /**
     * Add an ace
     *
     * @param  AccountACEinfo $xprop
     * @return self
     */
    public function addAce(AccountACEinfo $ace)
    {
        $this->_ace->add($ace);
        return $this;
    }

    /**
     * Gets ace sequence
     *
     * @return Sequence
     */
    public function ace()
    {
        return $this->_ace;
    }
}
