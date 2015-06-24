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
use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetSpec;

/**
 * CreateWaitSet request class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateWaitSet extends Base
{
    /**
     * Constructor method for CreateWaitSet
     * @param  WaitSetSpec $add
     * @param  array $defTypes
     * @param  bool $allAccounts
     * @return self
     */
    public function __construct(
        WaitSetSpec $add = null,
        array $defTypes = array(),
        $allAccounts = null
    )
    {
        parent::__construct();
        if($add instanceof WaitSetSpec)
        {
            $this->child('add', $add);
        }
        $this->_defTypes = new TypedSequence('Zimbra\Enum\InterestType', $defTypes);
        if(null !== $allAccounts)
        {
            $this->property('allAccounts', (bool) $allAccounts);
        }

        $this->on('before', function(Base $sender)
        {
            $defTypes = $sender->defTypes();
            if(!empty($defTypes))
            {
                $sender->property('defTypes', $defTypes);
            }
        });
    }

    /**
     * Get or set add WaitSet
     * WaitSet add specification
     *
     * @param  WaitSetSpec $add
     * @return WaitSetSpec|self
     */
    public function add(WaitSetSpec $add = null)
    {
        if(null === $add)
        {
            return $this->child('add');
        }
        return $this->child('add', $add);
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addDefTypes(InterestType $type)
    {
        $this->_defTypes->add($type);
        return $this;
    }

    /**
     * Gets types
     * Default interest types: comma-separated list
     *
     * @return string
     */
    public function defTypes()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : '';
    }

    /**
     * Get or set allAccounts
     * If {all-accounts} is set, then all mailboxes on the system will be listened to,
     * including any mailboxes which are created on the system while the WaitSet is in existence
     *
     * @param  bool $allAccounts
     * @return bool|self
     */
    public function allAccounts($allAccounts = null)
    {
        if(null === $allAccounts)
        {
            return $this->property('allAccounts');
        }
        return $this->property('allAccounts', (bool) $allAccounts);
    }
}
