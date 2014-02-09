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
        $this->child('owner', $owner);
        if($grantee instanceof Grantee)
        {
            $this->child('grantee', $grantee);
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
            return $this->child('owner');
        }
        return $this->child('owner', $owner);
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
}
