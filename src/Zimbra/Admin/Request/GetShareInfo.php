<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Struct\AccountSelector as Owner;
use Zimbra\Struct\GranteeChooser as Grantee;

/**
 * GetShareInfo request class
 * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareInfo extends Base
{
    /**
     * Constructor method for GetShareInfo
     * @param  Owner $owner
     * @param  Grantee $grantee
     * @return self
     */
    public function __construct(Owner $owner, Grantee $grantee = null)
    {
        parent::__construct();
        $this->setChild('owner', $owner);
        if($grantee instanceof Grantee)
        {
            $this->setChild('grantee', $grantee);
        }
    }

    /**
     * Gets the owner.
     *
     * @return Owner
     */
    public function getOwner()
    {
        return $this->getChild('owner');
    }

    /**
     * Sets the owner.
     *
     * @param  Owner $owner
     * @return self
     */
    public function setOwner(Owner $owner)
    {
        return $this->setChild('owner', $owner);
    }

    /**
     * Sets the grantee.
     *
     * @return Grantee
     */
    public function getGrantee()
    {
        return $this->getChild('grantee');
    }

    /**
     * Sets the grantee.
     *
     * @param  Grantee $grantee
     * @return self
     */
    public function setGrantee(Grantee $grantee)
    {
        return $this->setChild('grantee', $grantee);
    }
}
