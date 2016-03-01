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
        array $defTypes = [],
        $allAccounts = null
    )
    {
        parent::__construct();
        if($add instanceof WaitSetSpec)
        {
            $this->setChild('add', $add);
        }
        if(null !== $allAccounts)
        {
            $this->setProperty('allAccounts', (bool) $allAccounts);
        }

        $this->setDefaultInterests($defTypes);
        $this->on('before', function(Base $sender)
        {
            $defTypes = $sender->getDefaultInterests();
            if(!empty($defTypes))
            {
                $sender->setProperty('defTypes', $defTypes);
            }
        });
    }

    /**
     * Gets waitsets to add
     *
     * @return WaitSetSpec
     */
    public function getAccounts()
    {
        return $this->getChild('add');
    }

    /**
     * Sets waitsets to add
     *
     * @param  WaitSetSpec $add
     * @return self
     */
    public function setAccounts(WaitSetSpec $add)
    {
        return $this->setChild('add', $add);
    }

    /**
     * Add a default interest type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addDefaultInterest(InterestType $type)
    {
        $this->_defTypes->add($type);
        return $this;
    }

    /**
     * Sets default interest types
     *
     * @param  array $defTypes
     * @return self
     */
    public function setDefaultInterests(array $defTypes)
    {
        $this->_defTypes = new TypedSequence('Zimbra\Enum\InterestType', $defTypes);
        return $this;
    }

    /**
     * Gets default interest types
     * Default interest types: comma-separated list
     *
     * @return string
     */
    public function getDefaultInterests()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : '';
    }

    /**
     * Gets all accounts flag
     *
     * @return bool
     */
    public function getAllAccounts()
    {
        return $this->getProperty('allAccounts');
    }

    /**
     * Sets all accounts flag
     *
     * @param  bool $allAccounts
     *     If {all-accounts} is set, then all mailboxes on the system will be listened to,
     *     including any mailboxes which are created on the system while the WaitSet is in existence
     * @return self
     */
    public function setAllAccounts($allAccounts)
    {
        return $this->setProperty('allAccounts', (bool) $allAccounts);
    }
}
