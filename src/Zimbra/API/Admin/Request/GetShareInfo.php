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
use Zimbra\Soap\Struct\AccountSelector as Owner;
use Zimbra\Soap\Struct\GranteeChooser as Grantee;

/**
 * GetShareInfo class
 * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareInfo extends Request
{
    /**
     * Owner
     * @var Owner
     */
    private $_owner;

    /**
     * Grantee
     * @var Grantee
     */
    private $_grantee;

    /**
     * Constructor method for GetShareInfo
     * @param  Owner $owner
     * @param  Grantee $grantee
     * @return self
     */
    public function __construct(Owner $owner, Grantee $grantee = null)
    {
        parent::__construct();
        $this->_owner = $owner;
        if($grantee instanceof Grantee)
        {
            $this->_grantee = $grantee;
        }
    }

    /**
     * Gets or sets owner
     *
     * @param  Owner $owner
     * @return Owner|self
     */
    public function owner(Owner $owner = null)
    {
        if(null === $owner)
        {
            return $this->_owner;
        }
        $this->_owner = $owner;
        return $this;
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_owner->toArray('owner');
        if($this->_grantee instanceof Grantee)
        {
            $this->array += $this->_grantee->toArray();
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
        $this->xml->append($this->_owner->toXml('owner'));
        if($this->_grantee instanceof Grantee)
        {
            $this->xml->append($this->_grantee->toXml());
        }
        return parent::toXml();
    }
}
