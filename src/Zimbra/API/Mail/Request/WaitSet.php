<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Soap\Struct\WaitSetAdd;
use Zimbra\Soap\Struct\WaitSetRemove;
use Zimbra\Utils\TypedSequence;

/**
 * WaitSet request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSet extends Request
{
    /**
     * WaitSet add specification
     * @var WaitSetAdd
     */
    private $_add;

    /**
     * WaitSet update specification
     * @var WaitSetAdd
     */
    private $_update;

    /**
     * WaitSet remove specification
     * @var WaitSetRemove
     */
    private $_remove;

    /**
     * Waitset ID
     * @var string
     */
    private $_waitSet;

    /**
     * Last known sequence number
     * @var string
     */
    private $_seq;

    /**
     * Flag whether or not to block until some account has new data
     * @var bool
     */
    private $_block;

    /**
     * Default interest types: comma-separated list.
     * @var TypedSequence<InterestType>
     */
    private $_defTypes;

    /**
     * Timeout length
     * @var int
     */
    private $_timeout;

    /**
     * Constructor method for WaitSet
     * @param  string $waitSet
     * @param  string $seq
     * @param  WaitSetAdd $add
     * @param  bool $block
     * @param  array $defTypes
     * @param  int $timeout
     * @return self
     */
    public function __construct(
        $waitSet,
        $seq,
        WaitSetAdd $add = null,
        WaitSetAdd $update = null,
        WaitSetRemove $remove = null,
        $block = null,
        array $defTypes = array(),
        $timeout = null
    )
    {
        parent::__construct();
        $this->_waitSet = trim($waitSet);
        $this->_seq = trim($seq);

        if($add instanceof WaitSetAdd)
        {
            $this->_add = $add;
        }
        if($update instanceof WaitSetAdd)
        {
            $this->_update = $update;
        }
        if($remove instanceof WaitSetRemove)
        {
            $this->_remove = $remove;
        }
        if(null !== $block)
        {
            $this->_block = (bool) $block;
        }
        $this->_defTypes = new TypedSequence('Zimbra\Soap\Enum\InterestType', $defTypes);
        if(null !== $timeout)
        {
            $this->_timeout = (int) $timeout;
        }
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
            return $this->_waitSet;
        }
        $this->_waitSet = trim($waitSet);
        return $this;
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
            return $this->_seq;
        }
        $this->_seq = trim($seq);
        return $this;
    }

    /**
     * Get or set add WaitSet
     *
     * @param  WaitSetAdd $add
     * @return WaitSetAdd|self
     */
    public function add(WaitSetAdd $add = null)
    {
        if(null === $add)
        {
            return $this->_add;
        }
        $this->_add = $add;
        return $this;
    }

    /**
     * Get or set update WaitSet
     *
     * @param  WaitSetAdd $update
     * @return WaitSetAdd|self
     */
    public function update(WaitSetAdd $update = null)
    {
        if(null === $update)
        {
            return $this->_update;
        }
        $this->_update = $update;
        return $this;
    }


    /**
     * Get or set remove WaitSet
     *
     * @param  WaitSetRemove $remove
     * @return WaitSetRemove|self
     */
    public function remove(WaitSetRemove $remove = null)
    {
        if(null === $remove)
        {
            return $this->_remove;
        }
        $this->_remove = $remove;
        return $this;
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
            return $this->_block;
        }
        $this->_block = (bool) $block;
        return $this;
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
            return $this->_timeout;
        }
        $this->_timeout = (int) $timeout;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'waitSet' => $this->_waitSet,
            'seq' => $this->_seq,
        );
        if(is_bool($this->_block))
        {
            $this->array['block'] = $this->_block ? 1 : 0;
        }
        if(count($this->_defTypes))
        {
            $this->array['defTypes'] = $this->defTypes();
        }
        if(is_int($this->_timeout))
        {
            $this->array['timeout'] = $this->_timeout;
        }
        if($this->_add instanceof WaitSetAdd)
        {
            $this->array += $this->_add->toArray('add');
        }
        if($this->_update instanceof WaitSetAdd)
        {
            $this->array += $this->_update->toArray('update');
        }
        if($this->_remove instanceof WaitSetRemove)
        {
            $this->array += $this->_remove->toArray('remove');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('waitSet', $this->_waitSet)
                  ->addAttribute('seq', $this->_seq);
        if(is_bool($this->_block))
        {
            $this->xml->addAttribute('block', $this->_block ? 1 : 0);
        }
        if(count($this->_defTypes))
        {
            $this->xml->addAttribute('defTypes', $this->defTypes());
        }
        if(is_int($this->_timeout))
        {
            $this->xml->addAttribute('timeout', $this->_timeout);
        }
        if($this->_add instanceof WaitSetAdd)
        {
            $this->xml->append($this->_add->toXml('add'));
        }
        if($this->_update instanceof WaitSetAdd)
        {
            $this->xml->append($this->_update->toXml('update'));
        }
        if($this->_remove instanceof WaitSetRemove)
        {
            $this->xml->append($this->_remove->toXml('remove'));
        }
        return parent::toXml();
    }
}
