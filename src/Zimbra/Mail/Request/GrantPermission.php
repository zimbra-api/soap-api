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
 * GrantPermission request class
 * Grant account level permissions 
 * GrantPermissionResponse returns permissions that are successfully granted.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GrantPermission extends Base
{
    /**
     * Specify Access Control Entries (ACEs)
     * @var TypedSequence<AccountACEinfo>
     */
    private $_aces;

    /**
     * Constructor method for GrantPermission
     * @param  array $ace
     * @return self
     */
    public function __construct(array $aces = array())
    {
        parent::__construct();
        $this->setAces($aces);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAces()->count())
            {
                $sender->setChild('ace', $sender->getAces()->all());
            }
        });
    }

    /**
     * Add an access control entry
     *
     * @param  AccountACEinfo $ace
     * @return self
     */
    public function addAce(AccountACEinfo $ace)
    {
        $this->_aces->add($ace);
        return $this;
    }

    /**
     * Sets access control entries
     *
     * @param  array $aces
     * @return self
     */
    public function setAces(array $aces)
    {
        $this->_aces = new TypedSequence('Zimbra\Mail\Struct\AccountACEinfo', $aces);
        return $this;
    }

    /**
     * Gets access control entries
     *
     * @return Sequence
     */
    public function getAces()
    {
        return $this->_aces;
    }
}
