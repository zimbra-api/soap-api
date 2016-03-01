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

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Admin\Struct\GranteeSelector as Grantee;

/**
 * GetGrants request class
 * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetGrants extends Base
{
    /**
     * Constructor method for GetGrants
     * @param  Target $target
     * @param  Grantee $grantee
     * @return self
     */
    public function __construct(Target $target = null, Grantee $grantee = null)
    {
        parent::__construct();
        if($target instanceof Target)
        {
            $this->setChild('target', $target);
        }
        if($grantee instanceof Grantee)
        {
            $this->setChild('grantee', $grantee);
        }
    }

    /**
     * Gets the target.
     *
     * @return Target
     */
    public function getTarget()
    {
        return $this->getChild('target');
    }

    /**
     * Sets the target.
     *
     * @param  Target $target
     * @return self
     */
    public function setTarget(Target $target)
    {
        return $this->setChild('target', $target);
    }

    /**
     * Gets the grantee.
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
