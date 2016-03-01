<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetSpec;
use Zimbra\Struct\WaitSetId;

/**
 * AdminWaitSet request class
 * AdminWaitSetRequest optionally modifies the wait set and checks for any notifications.
 * If block=1 and there are no notifications, then this API will BLOCK until there is data.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminWaitSet extends Base
{
    /**
     * Default interest types
     * Comma-separated list
     * @var string
     */
    private $_defTypes;

    /**
     * Constructor method for AdminWaitSet
     * @param string $waitSet Waitset ID
     * @param string $seq Last known sequence number
     * @param WaitSetSpec $addAccounts The WaitSet add spec
     * @param WaitSetSpec $updateAccounts The WaitSet update spec
     * @param WaitSetId $removeAccounts The WaitSet remove spec
     * @param bool   $block Flag whether or not to block until some account has new data
     * @param array  $defTypes Default interest types. Comma-separated list
     * @param int    $timeout Timeout length
     * @return self
     */
    public function __construct(
        $waitSet,
        $seq,
        WaitSetSpec $addAccounts = null,
        WaitSetSpec $updateAccounts = null,
        WaitSetId $removeAccounts = null,
        $block = null,
        array $defTypes = [],
        $timeout = null
    )
    {
        parent::__construct();
        $this->setProperty('waitSet', trim($waitSet));
        $this->setProperty('seq', trim($seq));

        if($addAccounts instanceof WaitSetSpec)
        {
            $this->setChild('add', $addAccounts);
        }
        if($updateAccounts instanceof WaitSetSpec)
        {
            $this->setChild('update', $updateAccounts);
        }
        if($removeAccounts instanceof WaitSetId)
        {
            $this->setChild('remove', $removeAccounts);
        }

        if(null !== $block)
        {
            $this->setProperty('block', (bool) $block);
        }
        if(null !== $timeout)
        {
            $this->setProperty('timeout', (int) $timeout);
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
     * Gets Waitset ID
     *
     * @return string
     */
    public function getWaitSetId()
    {
        return $this->getProperty('waitSet');
    }

    /**
     * Sets Waitset ID
     *
     * @param  string $waitSet
     * @return self
     */
    public function setWaitSetId($waitSet)
    {
        return $this->setProperty('waitSet', trim($waitSet));
    }

    /**
     * Gets last known sequence number
     *
     * @return string
     */
    public function getLastKnownSeqNo()
    {
        return $this->getProperty('seq');
    }

    /**
     * Sets last known sequence number
     *
     * @param  string $seq
     * @return self
     */
    public function setLastKnownSeqNo($seq)
    {
        return $this->setProperty('seq', trim($seq));
    }

    /**
     * Gets the waitsets to add.
     *
     * @return WaitSetSpec
     */
    public function getAddAccounts()
    {
        return $this->getChild('add');
    }

    /**
     * Sets the waitsets to add.
     *
     * @param  WaitSetSpec $add
     * @return self
     */
    public function setAddAccounts(WaitSetSpec $add)
    {
        return $this->setChild('add', $add);
    }

    /**
     * Gets the waitsets to update.
     *
     * @return WaitSetSpec
     */
    public function getUpdateAccounts()
    {
        return $this->getChild('update');
    }

    /**
     * Sets the waitsets to update.
     *
     * @param  WaitSetSpec $update
     * @return self
     */
    public function setUpdateAccounts(WaitSetSpec $update)
    {
        return $this->setChild('update', $update);
    }

    /**
     * Gets the waitsets to remove.
     *
     * @return WaitSetId
     */
    public function getRemoveAccounts()
    {
        return $this->getChild('remove');
    }

    /**
     * Sets the waitsets to remove.
     *
     * @param  WaitSetId $remove
     * @return self
     */
    public function setRemoveAccounts(WaitSetId $remove)
    {
        return $this->setChild('remove', $remove);
    }

    /**
     * Gets block
     *
     * @return bool
     */
    public function getBlock()
    {
        return $this->getProperty('block');
    }

    /**
     * Sets block
     *
     * @param  bool $block
     * @return self
     */
    public function setBlock($block)
    {
        return $this->setProperty('block', (bool) $block);
    }

    /**
     * Gets timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->getProperty('timeout');
    }

    /**
     * Sets timeout
     *
     * @param  string $timeout
     * @return int
     */
    public function setTimeout($timeout)
    {
        return $this->setProperty('timeout', (int) $timeout);
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
     *
     * @return string
     */
    public function getDefaultInterests()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : 'all';
    }
}
