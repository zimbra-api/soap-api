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
        $this->child('target', $target);
        if($grantee instanceof Grantee)
        {
            $this->child('grantee', $grantee);
        }
        if($expandAllAttrs instanceof AttrMethod)
        {
            $this->property('expandAllAttrs', $expandAllAttrs);
        }
    }

    /**
     * Gets or sets target
     *
     * @param  Target $target
     * @return Target|self
     */
    public function target(Target $target = null)
    {
        if(null === $target)
        {
            return $this->child('target');
        }
        return $this->child('target', $target);
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
     * Gets or sets expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return string|self
     */
    public function expandAllAttrs(AttrMethod $expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->property('expandAllAttrs');
        }
        return $this->property('expandAllAttrs', $expandAllAttrs);
    }
}
