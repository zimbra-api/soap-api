<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\MemberOfSelector as MemberOf;

/**
 * GetAccountDistributionLists class
 * Returns groups the user is either a member or an owner of. 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccountDistributionLists extends Request
{
    /**
     * The ownerOf
     * Set to 1 if the response should include groups the user is an owner of. 
     * Set to 0 (default) if do not need to know which groups the user is an owner of.
     * @var boolean
     */
    private $_ownerOf;

    /**
     * The memberOf
     * @var MemberOf
     */
    private $_memberOf;

    /**
     * The attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for GetAccountDistributionLists
     * @param  bool   $ownerOf
     * @param  MemberOf $memberOf
     * @param  string $attrs
     * @return self
     */
    public function __construct($ownerOf = null, MemberOf $memberOf = null, $attrs = null)
    {
        parent::__construct();
        if(null !== $ownerOf)
        {
            $this->_ownerOf = (bool) $ownerOf;
        }
        if($memberOf instanceof MemberOf)
        {
            $this->_memberOf = $memberOf;
        }
        $this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets ownerOf
     *
     * @param  bool $ownerOf
     * @return bool|self
     */
    public function ownerOf($ownerOf = null)
    {
        if(null === $ownerOf)
        {
            return $this->_ownerOf;
        }
        $this->_ownerOf = (bool) $ownerOf;
        return $this;
    }

    /**
     * Gets or sets memberOf
     *
     * @param  MemberOf $memberOf
     * @return MemberOf|self
     */
    public function memberOf(MemberOf $memberOf = null)
    {
        if(null === $memberOf)
        {
            return $this->_memberOf;
        }
        $this->_memberOf = $memberOf;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_ownerOf))
        {
            $this->array['ownerOf'] = $this->_ownerOf ? 1 : 0;
        }
        if($this->_memberOf instanceof MemberOf)
        {
            $this->array['memberOf'] = (string) $this->_memberOf;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
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
        if(is_bool($this->_ownerOf))
        {
            $this->xml->addAttribute('ownerOf', $this->_ownerOf ? 1 : 0);
        }
        if($this->_memberOf instanceof MemberOf)
        {
            $this->xml->addAttribute('memberOf', (string) $this->_memberOf);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
