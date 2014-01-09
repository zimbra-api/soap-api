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
     * @var WaitSetAdd
     */
    private $_add;

    /**
     * Default interest types: comma-separated list
     * @var TypedSequence<InterestType>
     */
    private $_defTypes;

    /**
     * If {all-accounts} is set, then all mailboxes on the system will be listened to,
     * including any mailboxes which are created on the system while the WaitSet is in existence
     * @var bool
     */
    private $_allAccounts;

    /**
     * Constructor method for CreateWaitSet
     * @param  WaitSetAdd $add
     * @param  array $defTypes
     * @param  bool $allAccounts
     * @return self
     */
    public function __construct(
        WaitSetAdd $add = null,
        array $defTypes = array(),
        $allAccounts = null
    )
    {
        parent::__construct();
        if($add instanceof WaitSetAdd)
        {
            $this->_add = $add;
        }
        $this->_defTypes = new TypedSequence('Zimbra\Soap\Enum\InterestType', $defTypes);
        if(null !== $allAccounts)
        {
            $this->_allAccounts = (bool) $allAccounts;
        }
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
        if($this->_add instanceof WaitSetAdd)
        {
            $this->array += $this->_add->toArray('add');
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
        if($this->_add instanceof WaitSetAdd)
        {
            $this->xml->append($this->_add->toXml('add'));
        }
        return parent::toXml();
    }
}
