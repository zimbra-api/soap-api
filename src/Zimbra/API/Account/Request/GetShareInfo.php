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
use Zimbra\Soap\Struct\AccountSelector as Account;
use Zimbra\Soap\Struct\GranteeChooser as Grantee;

/**
 * GetShareInfo class
 * Get information about published shares
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareInfo extends Request
{
    /**
     * The grantee
     * Filter by the specified grantee type
     * @var GranteeChooser
     */
    private $_grantee;
    /**
     * The owner
     * Specifies the owner of the share
     * @var Account
     */
    private $_owner;

    /**
     * The internal
     * Flags that have been proxied to this server because the specified "owner account" is homed here.
     * Do not proxy in this case. (Used internally by ZCS)
     * @var boolean
     */
    private $_internal;

    /**
     * The includeSelf
     * Flag whether own shares should be included:
     *   1. 0 if shares owned by the requested account should not be included in the response
     *   2. 1 (default) include shares owned by the requested account
     * @var boolean
     */
    private $_includeSelf;

    /**
     * Constructor method for GetShareInfo
     * @param Grantee $grantee
     * @param Account $owner
     * @param bool $internal
     * @param bool $includeSelf
     * @return self
     */
    public function __construct(
        Grantee $grantee = null,
        Account $owner = null,
        $internal = null,
        $includeSelf = null
    )
    {
        parent::__construct();
        if($grantee instanceof Grantee)
        {
            $this->_grantee = $grantee;
        }
        if($owner instanceof Account)
        {
            $this->_owner = $owner;
        }
        if(null !== $internal)
        {
            $this->_internal = (bool) $internal;
        }
        if(null !== $includeSelf)
        {
            $this->_includeSelf = (bool) $includeSelf;
        }
    }

    /**
     * Gets or sets grantee
     *
     * @param  Grantee $grantee
     * @return Grantee|self
     */
    public function grantee(Grantee $grantee = null)
    {
        if(null === $grantee)
        {
            return $this->_grantee;
        }
        $this->_grantee = $grantee;
        return $this;
    }

    /**
     * Gets or sets owner
     *
     * @param  Account $owner
     * @return Account|self
     */
    public function owner(Account $owner = null)
    {
        if(null === $owner)
        {
            return $this->_owner;
        }
        $this->_owner = $owner;
        return $this;
    }

    /**
     * Gets or sets internal
     *
     * @param  bool $internal
     * @return bool|self
     */
    public function internal($internal = null)
    {
        if(null === $internal)
        {
            return $this->_internal;
        }
        $this->_internal = (bool) $internal;
        return $this;
    }

    /**
     * Gets or sets includeSelf
     *
     * @param  bool $includeSelf
     * @return bool|self
     */
    public function includeSelf($includeSelf = null)
    {
        if(null === $includeSelf)
        {
            return $this->_includeSelf;
        }
        $this->_includeSelf = (bool) $includeSelf;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_grantee instanceof Grantee)
        {
            $this->array += $this->_grantee->toArray();
        }
        if($this->_owner instanceof Account)
        {
            $this->array += $this->_owner->toArray('owner');
        }
        if(is_bool($this->_internal))
        {
            $this->array['internal'] = $this->_internal ? 1 : 0;
        }
        if(is_bool($this->_includeSelf))
        {
            $this->array['includeSelf'] = $this->_includeSelf ? 1 : 0;
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
        if($this->_grantee instanceof Grantee)
        {
            $this->xml->append($this->_grantee->toXml());
        }
        if($this->_owner instanceof Account)
        {
            $this->xml->append($this->_owner->toXml('owner'));
        }
        if(is_bool($this->_internal))
        {
            $this->xml->addAttribute('internal', $this->_internal ? 1 : 0);
        }
        if(is_bool($this->_includeSelf))
        {
            $this->xml->addAttribute('includeSelf', $this->_includeSelf ? 1 : 0);
        }
        return parent::toXml();
    }
}
