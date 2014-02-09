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

use Zimbra\Enum\MemberOfSelector as MemberOf;

/**
 * GetAccountDistributionLists request class
 * Returns groups the user is either a member or an owner of. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccountDistributionLists extends Base
{
    /**
     * Constructor method for GetAccountDistributionLists
     * @param  bool $ownerOf The ownerOf
     * @param  MemberOf $memberOf The memberOf
     * @param  string $attrs The attributes
     * @return self
     */
    public function __construct($ownerOf = null, MemberOf $memberOf = null, $attrs = null)
    {
        parent::__construct();
        if(null !== $ownerOf)
        {
            $this->property('ownerOf', (bool) $ownerOf);
        }
        if($memberOf instanceof MemberOf)
        {
            $this->property('memberOf', $memberOf);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
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
            return $this->property('ownerOf');
        }
        return $this->property('ownerOf', (bool) $ownerOf);
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
            return $this->property('memberOf');
        }
        return $this->property('memberOf', $memberOf);
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
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
