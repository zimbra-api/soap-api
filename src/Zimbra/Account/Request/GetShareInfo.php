<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Struct\AccountSelector as Account;
use Zimbra\Struct\GranteeChooser as Grantee;

/**
 * GetShareInfo request class
 * Get information about published shares
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareInfo extends Base
{
    /**
     * Constructor method for GetShareInfo
     * @param Grantee $grantee Filter by the specified grantee type
     * @param Account $owner Specifies the owner of the share
     * @param bool $internal Flags that have been proxied to this server because the specified "owner account" is homed here. Do not proxy in this case.
     * @param bool $includeSelf Flag whether own shares should be included
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
            $this->setChild('grantee', $grantee);
        }
        if($owner instanceof Account)
        {
            $this->setChild('owner', $owner);
        }
        if(null !== $internal)
        {
            $this->setProperty('internal', (bool) $internal);
        }
        if(null !== $includeSelf)
        {
            $this->setProperty('includeSelf', (bool) $includeSelf);
        }
    }

    /**
     * Gets the grantee
     *
     * @return Grantee
     */
    public function getGrantee()
    {
        return $this->getChild('grantee');
    }

    /**
     * Sets the grantee
     *
     * @param  Grantee $grantee
     * @return self
     */
    public function setGrantee(Grantee $grantee)
    {
        return $this->setChild('grantee', $grantee);
    }

    /**
     * Gets the owner
     *
     * @return Account
     */
    public function getOwner()
    {
        return $this->getChild('owner');
    }

    /**
     * Sets the owner
     *
     * @param  Account $owner
     * @return self
     */
    public function setOwner(Account $owner)
    {
        return $this->setChild('owner', $owner);
    }

    /**
     * Gets internal
     *
     * @return bool
     */
    public function getInternal()
    {
        return $this->getProperty('internal');
    }

    /**
     * Sets internal
     *
     * @param  bool $internal
     * @return self
     */
    public function setInternal($internal)
    {
        return $this->setProperty('internal', (bool) $internal);
    }

    /**
     * Gets include self
     *
     * @return bool
     */
    public function getIncludeSelf()
    {
        return $this->getProperty('includeSelf');
    }

    /**
     * Sets include self
     *
     * @param  bool $includeSelf
     * @return self
     */
    public function setIncludeSelf($includeSelf)
    {
        return $this->setProperty('includeSelf', (bool) $includeSelf);
    }
}
