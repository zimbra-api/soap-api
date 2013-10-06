<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Id;
use Zimbra\Soap\Struct\WaitSetAddSpec as WaitSet;

/**
 * AdminWaitSet class
 * AdminWaitSetRequest optionally modifies the wait set and checks for any notifications.
 * If block=1 and there are no notifications, then this API will BLOCK until there is data.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminWaitSet extends Request
{
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
     * The WaitSet add spec array
     * @var array
     */
    private $_addWaitSets = array();

    /**
     * The WaitSet update spec array
     * @var array
     */
    private $_updateWaitSets = array();

    /**
     * The WaitSet remove spec array
     * @var array
     */
    private $_removeWaitSets = array();

    /**
     * Flag whether or not to block until some account has new data
     * @var boolean
     */
    private $_block;

    /**
     * Default interest types: comma-separated list
     * @var string
     */
    private $_defTypes;

    /**
     * Timeout length
     * @var long
     */
    private $_timeout;

    /**
     * Constructor method for AdminWaitSet
     * @param string $waitSet
     * @param string $seq
     * @param bool   $block
     * @param string $defTypes
     * @param int    $timeout
     * @param array  $addWaitSets
     * @param array  $updateWaitSets
     * @param array  $removeWaitSets
     * @return self
     */
    public function __construct(
        $waitSet,
        $seq,
        $block = null,
        $defTypes = null,
        $timeout = null,
        array $addWaitSets = array(),
        array $updateWaitSets = array(),
        array $removeWaitSets = array()
    )
    {
        parent::__construct();
        $this->_waitSet = trim($waitSet);
        $this->_seq = trim($seq);
        $this->addWaitSets($addWaitSets);
        $this->updateWaitSets($updateWaitSets);
        $this->removeWaitSets($removeWaitSets);

        if(null !== $block)
        {
            $this->_block = (bool) $block;
        }
        if(null !== $defTypes)
        {
            $this->defTypes($defTypes);
        }
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
     * Gets or sets defTypes
     *
     * @param  string $defTypes
     * @return string|self
     */
    public function defTypes($defTypes = null)
    {
        if(null === $defTypes)
        {
            return $this->_defTypes;
        }
        $validTypes = array('f', 'm', 'c', 'a', 't', 'd', 'all');
        $types = array();
        $defTypes = explode(',', $defTypes);
        foreach ($defTypes as $type)
        {
            $type = trim($type);
            if(in_array($type, $validTypes))
            {
                $types[] = $type;
            }
        }
        $this->_defTypes = implode(',', $types);
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
     * Gets or sets timeout
     *
     * @param  int $timeout
     * @return int|AdminCreateWaitSet
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
     * Add a WaitSet add
     *
     * @param  WaitSet $spec
     * @return AdminWaitSet
     */
    public function addWaitSet(WaitSet $spec)
    {
        $this->_addWaitSets[] = $spec;
        return $this;
    }

    /**
     * Gets or sets addWaitSets
     *
     * @param  array $addWaitSets
     * @return array|self
     */
    public function addWaitSets(array $addWaitSets = null)
    {
        if(null === $addWaitSets)
        {
            return $this->_addWaitSets;
        }
        $this->_addWaitSets = array();
        foreach ($addWaitSets as $spec)
        {
            if($spec instanceof WaitSet)
            {
                $this->_addWaitSets[] = $spec;
            }
        }
        return $this;
    }

    /**
     * Add a WaitSet update
     *
     * @param  WaitSet $spec
     * @return AdminWaitSet
     */
    public function addUpdate(WaitSet $spec)
    {
        $this->_updateWaitSets[] = $spec;
        return $this;
    }

    /**
     * Gets or sets updateWaitSets
     *
     * @param  array $updateWaitSets
     * @return array|self
     */
    public function updateWaitSets(array $updateWaitSets = null)
    {
        if(null === $updateWaitSets)
        {
            return $this->_updateWaitSets;
        }
        $this->_updateWaitSets = array();
        foreach ($updateWaitSets as $spec)
        {
            if($spec instanceof WaitSet)
            {
                $this->_updateWaitSets[] = $spec;
            }
        }
        return $this;
    }

    /**
     * Add a Id spec
     *
     * @param  Id $id
     * @return AdminWaitSet
     */
    public function addRemove(Id $id)
    {
        $this->_removeWaitSets[] = $id;
        return $this;
    }

    /**
     * Gets or sets removeWaitSets
     *
     * @param  array $removeWaitSets
     * @return array|self
     */
    public function removeWaitSets(array $removeWaitSets = null)
    {
        if(null === $removeWaitSets)
        {
            return $this->_removeWaitSets;
        }
        $this->_removeWaitSets = array();
        foreach ($removeWaitSets as $id)
        {
            if($id instanceof Id)
            {
                $this->_removeWaitSets[] = $id;
            }
        }
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
            'add' => array(),
            'update' => array(),
            'remove' => array(),
        );
        if(is_bool($this->_block))
        {
            $this->array['block'] = $this->_block ? 1 : 0;
        }
        if(!empty($this->_defTypes))
        {
            $this->array['defTypes'] = $this->_defTypes;
        }
        if(is_int($this->_timeout))
        {
            $this->array['timeout'] = $this->_timeout;
        }
        if(count($this->_addWaitSets))
        {
            $this->array['add']['a'] = array();
            foreach ($this->_addWaitSets as $spec)
            {
                $specArr = $spec->toArray('a');
                $this->array['add']['a'][] = $specArr['a'];
            }
        }
        if(count($this->_updateWaitSets))
        {
            $this->array['update']['a'] = array();
            foreach ($this->_updateWaitSets as $spec)
            {
                $specArr = $spec->toArray('a');
                $this->array['update']['a'][] = $specArr['a'];
            }
        }
        if(count($this->_removeWaitSets))
        {
            $this->array['remove']['a'] = array();
            foreach ($this->_removeWaitSets as $spec)
            {
                $specArr = $spec->toArray('a');
                $this->array['remove']['a'][] = $specArr['a'];
            }
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
        if(!empty($this->_defTypes))
        {
            $this->xml->addAttribute('defTypes', $this->_defTypes);
        }
        if(is_int($this->_timeout))
        {
            $this->xml->addAttribute('timeout', $this->_timeout);
        }
        $add = $this->xml->addChild('add', null);
        foreach ($this->_addWaitSets as $spec)
        {
            $add->append($spec->toXml('a'));
        }
        $update = $this->xml->addChild('update', null);
        foreach ($this->_updateWaitSets as $spec)
        {
            $update->append($spec->toXml('a'));
        }
        $remove = $this->xml->addChild('remove', null);
        foreach ($this->_removeWaitSets as $spec)
        {
            $remove->append($spec->toXml('a'));
        }
        return parent::toXml();
    }
}
