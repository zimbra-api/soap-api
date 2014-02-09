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
            $this->child('grantee', $grantee);
        }
        if($owner instanceof Account)
        {
            $this->child('owner', $owner);
        }
        if(null !== $internal)
        {
            $this->property('internal', (bool) $internal);
        }
        if(null !== $includeSelf)
        {
            $this->property('includeSelf', (bool) $includeSelf);
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
            return $this->child('grantee');
        }
        return $this->child('grantee', $grantee);
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
            return $this->child('owner');
        }
        return $this->child('owner', $owner);
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
            return $this->property('internal');
        }
        return $this->property('internal', (bool) $internal);
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
            return $this->property('includeSelf');
        }
        return $this->property('includeSelf', (bool) $includeSelf);
    }
}
