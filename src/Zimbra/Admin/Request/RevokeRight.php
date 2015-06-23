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
use Zimbra\Admin\Struct\RightModifierInfo as Right;

/**
 * RevokeRight request class
 * GrantRevoke a right from a target that was previously granted to an individual or group grantee.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokeRight extends Base
{
    /**
     * Constructor method for RevokeRight 
     * @param  Hostname $target Target selector
     * @param  StatsSpec $stats Grantee selector
     * @param  string $limit Right
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee,
        Right $right
    )
    {
        parent::__construct();
        $this->setChild('target', $target);
        $this->setChild('grantee', $grantee);
        $this->setChild('right', $right);
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
     * Gets the right.
     *
     * @return Right
     */
    public function getRight()
    {
        return $this->getChild('right');
    }

    /**
     * Sets the right.
     *
     * @param  Right $right
     * @return self
     */
    public function setRight(Right $right)
    {
        return $this->setChild('right', $right);
    }
}