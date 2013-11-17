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
use Zimbra\Soap\Struct\WaitSetAddSpec as WaitSet;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Utils\TypedSequence;

/**
 * AdminCreateWaitSet class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AdminCreateWaitSet extends Request
{
    /**
     * Default interest types
     * @var array
     */
    private $_defTypes;

    /**
     * The allAccounts
     * @var boolean
     */
    private $_allAccounts;

    /**
     * The WaitSet add spec array
     * @var array
     */
    private $_waitSets;

    /**
     * Constructor method for AdminCreateWaitSet
     * @param  array $defTypes
     * @param  array $waitSets
     * @param  bool  $allAccounts
     * @return self
     */
    public function __construct(array $defTypes, array $waitSets = array(), $allAccounts = null)
    {
        parent::__construct();
        $this->_defTypes = new TypedSequence('Zimbra\Soap\Enum\InterestType', $defTypes);
        $this->_waitSets = new TypedSequence('Zimbra\Soap\Struct\WaitSetAddSpec', $waitSets);
        if(null !== $allAccounts)
        {
            $this->_allAccounts = (bool) $allAccounts;
        }
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
     * Gets defTypes
     *
     * @return string
     */
    public function defTypes()
    {
        return count($this->_defTypes) ? implode(',', $this->_defTypes->all()) : 'all';
    }

    /**
     * Add a WaitSet
     *
     * @param  WaitSet $spec
     * @return self
     */
    public function addWaitSet(WaitSet $spec)
    {
        $this->_waitSets->add($spec);
        return $this;
    }

    /**
     * Gets addWaitSet Sequence
     *
     * @return Sequence
     */
    public function WaitSets()
    {
        return $this->_waitSets;
    }

    /**
     * Gets or sets allAccounts
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
        $this->array = array(
            'defTypes' => $this->defTypes(),
            'add' => array(),
        );
        if(is_bool($this->_allAccounts))
        {
            $this->array['allAccounts'] = $this->_allAccounts ? 1 : 0;
        }
        if(count($this->_waitSets))
        {
            $this->array['add']['a'] = array();
            foreach ($this->_waitSets as $spec)
            {
                $specArr = $spec->toArray('a');
                $this->array['add']['a'][] = $specArr['a'];
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
        $this->xml->addAttribute('defTypes', $this->defTypes());
        if(is_bool($this->_allAccounts))
        {
            $this->xml->addAttribute('allAccounts', $this->_allAccounts ? 1 : 0);
        }
        $add = $this->xml->addChild('add', null);
        foreach ($this->_waitSets as $spec)
        {
            $add->append($spec->toXml('a'));
        }
        return parent::toXml();
    }
}
