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

use Zimbra\Admin\Struct\WaitSetSpec;
use Zimbra\Admin\Struct\WaitSetId;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\InterestType;

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
     * @param WaitSetSpec $add The WaitSet add spec
     * @param WaitSetSpec $update The WaitSet update spec
     * @param WaitSetId $remove The WaitSet remove spec
     * @param bool   $block Flag whether or not to block until some account has new data
     * @param array  $defTypes Default interest types. Comma-separated list
     * @param int    $timeout Timeout length
     * @return self
     */
    public function __construct(
        $waitSet,
        $seq,
        WaitSetSpec $add = null,
        WaitSetSpec $update = null,
        WaitSetId $remove = null,
        $block = null,
        array $defTypes = array(),
        $timeout = null
    )
    {
        parent::__construct();
        $this->property('waitSet', trim($waitSet));
        $this->property('seq', trim($seq));

        $this->child('add', $add);
        $this->child('update', $update);
        $this->child('remove', $remove);

        if(null !== $block)
        {
            $this->property('block', (bool) $block);
        }
        $this->_defTypes = new TypedSequence('Zimbra\Enum\InterestType', $defTypes);
        if(null !== $timeout)
        {
            $this->property('timeout', (int) $timeout);
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
     * Gets or sets waitSet
     *
     * @param  string $waitSet
     * @return string|self
     */
    public function waitSet($waitSet = null)
    {
        if(null === $waitSet)
        {
            return $this->property('waitSet');
        }
        return $this->property('waitSet', trim($waitSet));
    }

    /**
     * Gets or sets seq
     *
     * @param  string $seq
     * @return string|self
     */
    public function seq($seq = null)
    {
        if(null === $seq)
        {
            return $this->property('seq');
        }
        return $this->property('seq', trim($seq));
    }

    /**
     * Gets or sets add
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
     * Gets or sets update
     *
     * @param  WaitSetSpec $update
     * @return WaitSetSpec|self
     */
    public function update(WaitSetSpec $update = null)
    {
        if(null === $update)
        {
            return $this->child('update');
        }
        return $this->child('update', $update);
    }

    /**
     * Gets or sets remove
     *
     * @param  WaitSetId $remove
     * @return WaitSetId|self
     */
    public function remove(WaitSetId $remove = null)
    {
        if(null === $remove)
        {
            return $this->child('remove');
        }
        return $this->child('remove', $remove);
    }

    /**
     * Gets or sets block
     *
     * @param  bool $block
     * @return bool|self
     */
    public function block($block = null)
    {
        if(null === $block)
        {
            return $this->property('block');
        }
        return $this->property('block', (bool) $block);
    }

    /**
     * Gets or sets timeout
     *
     * @param  int $timeout
     * @return int|self
     */
    public function timeout($timeout = null)
    {
        if(null === $timeout)
        {
            return $this->property('timeout');
        }
        return $this->property('timeout', (int) $timeout);
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addDefType(InterestType $type)
    {
        $this->_defTypes->add($type);
        return $this;
    }

    /**
     * Gets defType
     *
     * @return string
     */
    public function defTypes()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : '';
    }
}
