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
     * comma-separated list
     * @var string
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
    private $_addWaitSets = array();

    private static $_validTypes = array('f', 'm', 'c', 'a', 't', 'd', 'all');

    /**
     * Constructor method for AdminCreateWaitSet
     * @param  string $defTypes
     * @param  bool   $allAccounts
     * @param  array  $addWaitSets
     * @return self
     */
    public function __construct($defTypes, $allAccounts = null, array $addWaitSets = array())
    {
        parent::__construct();
        $this->defTypes($defTypes);
        if(null !== $allAccounts)
        {
            $this->_allAccounts = (bool) $allAccounts;
        }
        $this->addWaitSets($addWaitSets);
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
        $types = array();
        $defTypes = explode(',', $defTypes);
        foreach ($defTypes as $type)
        {
            $type = trim($type);
            if(in_array($type, self::$_validTypes))
            {
                $types[] = $type;
            }
        }
        $this->_defTypes = implode(',', $types);
        return $this;
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
     * Add a WaitSet
     *
     * @param  WaitSet $spec
     * @return self
     */
    public function addSpec(WaitSet $spec)
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'defTypes' => $this->_defTypes,
            'add' => array(),
        );
        if(is_bool($this->_allAccounts))
        {
            $this->array['allAccounts'] = $this->_allAccounts ? 1 : 0;
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
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('defTypes', $this->_defTypes);
        if(is_bool($this->_allAccounts))
        {
            $this->xml->addAttribute('allAccounts', $this->_allAccounts ? 1 : 0);
        }
        $add = $this->xml->addChild('add', null);
        foreach ($this->_addWaitSets as $spec)
        {
            $add->append($spec->toXml('a'));
        }
        return parent::toXml();
    }
}
