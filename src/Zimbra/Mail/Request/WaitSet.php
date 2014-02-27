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
use Zimbra\Mail\Struct\WaitSetSpec;
use Zimbra\Mail\Struct\WaitSetId;

/**
 * WaitSet request class
 * WaitSetRequest optionally modifies the wait set and checks for any notifications.
 * If block is set and there are no notificatins, then this API will BLOCK until there is data.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSet extends Base
{
    /**
     * Default interest types: comma-separated list.
     * @var TypedSequence<InterestType>
     */
    private $_defTypes;

    /**
     * Constructor method for WaitSet
     * @param  string $waitSet
     * @param  string $seq
     * @param  WaitSetSpec $add
     * @param  WaitSetSpec $update
     * @param  WaitSetId $remove
     * @param  bool $block
     * @param  array $defTypes
     * @param  int $timeout
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

        if($add instanceof WaitSetSpec)
        {
            $this->child('add', $add);
        }
        if($update instanceof WaitSetSpec)
        {
            $this->child('update', $update);
        }
        if($remove instanceof WaitSetId)
        {
            $this->child('remove', $remove);
        }
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
     * Get or set add WaitSet
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
     * Get or set update WaitSet
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
     * Get or set remove WaitSet
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
     *
     * @return string
     */
    public function defTypes()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : '';
    }

    /**
     * Get or set timeout
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
}
