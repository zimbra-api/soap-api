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
use Zimbra\Soap\Struct\WaitSetAddSpec;
use Zimbra\Utils\TypedSequence;

/**
 * CreateWaitSet request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateWaitSet extends Request
{
    /**
     * WaitSet add specification
     * @var TypedSequence<WaitSetAddSpec>
     */
    private $_add;

    /**
     * WaitSet add specification
     * @var TypedSequence<InterestType>
     */
    private $_defTypes;

    /**
     * WaitSet add specification
     * @var bool
     */
    private $_allAccounts;

    /**
     * Constructor method for CreateWaitSet
     * @param  WaitSetAddSpec $add
     * @return self
     */
    public function __construct(
        array $add = array(),
        array $defTypes = array(),
        $allAccounts = null
    )
    {
        parent::__construct();
        $this->_add = new TypedSequence('Zimbra\Soap\Struct\WaitSetAddSpec', $add);
        $this->_defTypes = new TypedSequence('Zimbra\Soap\Enum\InterestType', $defTypes);
        if(null !== $allAccounts)
        {
            $this->_allAccounts = (bool) $allAccounts;
        }
    }

    /**
     * Get or set add
     *
     * @param  WaitSetAddSpec $add
     * @return self
     */
    public function addWaitSet(WaitSetAddSpec $add)
    {
        $this->_add->add($add);
        return $this;
    }

    /**
     * Get or set add
     *
     * @return TypedSequence<WaitSetAddSpec>
     */
    public function add()
    {
        return $this->_add;
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
     * Get or set allAccounts
     *
     * @param  bool $allAccounts
     * @return bool|self
     */
    public function allAccounts($allAccounts = null)
    {
        if(null === $allAccounts)
        {
            return $this->_allAccounts;
        }
        $this->_allAccounts = (bool) $allAccounts;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['defTypes'] = $this->defTypes();
        if(is_bool($this->_allAccounts))
        {
            $this->array['allAccounts'] = $this->_allAccounts ? 1 : 0;
        }
        $this->array['add'] = array();
        if(count($this->_add))
        {
            $arr['a'] = array();
            foreach ($this->_add as $add)
            {
                $addArr = $add->toArray('a');
                $arr['a'][] = $addArr['a'];
            }
            $this->array['add'] = $arr;
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
        $this->xml->addAttribute('defTypes', $this->defTypes());
        if(is_bool($this->_allAccounts))
        {
            $this->xml->addAttribute('allAccounts', $this->_allAccounts ? 1 : 0);
        }
        $add = $this->xml->addChild('add');
        foreach ($this->_add as $a)
        {
            $add->append($a->toXml('a'));
        }
        return parent::toXml();
    }
}
