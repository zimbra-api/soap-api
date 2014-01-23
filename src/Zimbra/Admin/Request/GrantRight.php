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

use Zimbra\Soap\Request;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Admin\Struct\GranteeSelector as Grantee;
use Zimbra\Admin\Struct\RightModifierInfo as Right;

/**
 * GrantRight request class
 * Grant a right on a target to an individual or group grantee.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GrantRight extends Request
{
    /**
     * Constructor method for GrantRight
     * @param  Target $target Target selector
     * @param  Grantee $grantee Grantee selector
     * @param  Right $right Right
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee,
        Right $right
    )
    {
        parent::__construct();
        $this->child('target', $target);
        $this->child('grantee', $grantee);
        $this->child('right', $right);
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
     * Gets or sets right
     *
     * @param  Right $right
     * @return Right|self
     */
    public function right(Right $right = null)
    {
        if(null === $right)
        {
            return $this->child('right');
        }
        return $this->child('right', $right);
    }
}