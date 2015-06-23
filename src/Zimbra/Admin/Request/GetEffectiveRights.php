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
use Zimbra\Enum\AttrMethod;

/**
 * GetEffectiveRights request class
 * Returns effective ADMIN rights the authenticated admin has on the specified target entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetEffectiveRights extends Base
{
    /**
     * Constructor method for GetEffectiveRights
     * @param  Target $target
     * @param  Grantee $grantee
     * @param  string $expandAllAttrs Whether to include all attribute names in the <getAttrs>/<setAttrs> elements in the response if all attributes of the target are gettable/settable.
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee = null,
        AttrMethod $expandAllAttrs = null)
    {
        parent::__construct();
        $this->setChild('target', $target);
        if($grantee instanceof Grantee)
        {
            $this->setChild('grantee', $grantee);
        }
        if($expandAllAttrs instanceof AttrMethod)
        {
            $this->setProperty('expandAllAttrs', $expandAllAttrs);
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

    /**
     * Gets expandAllAttrs
     *
     * @return AttrMethod
     */
    public function getExpandAllAttrs()
    {
        return $this->getProperty('expandAllAttrs');
    }

    /**
     * Sets expandAllAttrs
     *
     * @param  AttrMethod $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(AttrMethod $expandAllAttrs)
    {
        return $this->setProperty('expandAllAttrs', $expandAllAttrs);
    }
}
