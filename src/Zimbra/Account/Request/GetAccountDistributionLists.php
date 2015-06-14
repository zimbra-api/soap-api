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
            $this->setProperty('ownerOf', (bool) $ownerOf);
        }
        if($memberOf instanceof MemberOf)
        {
            $this->setProperty('memberOf', $memberOf);
        }
        if(null !== $attrs)
        {
            $this->setProperty('attrs', trim($attrs));
        }
    }

    /**
     * Gets owner of
     *
     * @return bool
     */
    public function getOwnerOf()
    {
        return $this->getProperty('ownerOf');
    }

    /**
     * Sets owner of
     *
     * @param  bool $ownerOf
     * @return self
     */
    public function setOwnerOf($ownerOf)
    {
        return $this->setProperty('ownerOf', (bool) $ownerOf);
    }

    /**
     * Sets account member of enum
     *
     * @return MemberOf
     */
    public function getMemberOf()
    {
        return $this->getProperty('memberOf');
    }

    /**
     * Gets account member of enum
     *
     * @param  MemberOf $memberOf
     * @return self
     */
    public function setMemberOf(MemberOf $memberOf)
    {
        return $this->setProperty('memberOf', $memberOf);
    }

    /**
     * Gets attributes
     *
     * @return bool
     */
    public function getAttrs()
    {
        return $this->getProperty('attrs');
    }

    /**
     * Sets attributes
     *
     * @param  bool $attrs
     * @return self
     */
    public function setAttrs($attrs)
    {
        return $this->setProperty('attrs', trim($attrs));
    }
}
