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
 * CheckRight request class
 * Check if a principal has the specified right on target.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRight extends BaseAttr
{
    /**
     * Constructor method for CheckRight
     * @param Target $target The target
     * @param Grantee $grantee The grantee
     * @param string $right Checked right
     * @param array  $attrs Attributes
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee,
        $right,
        array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setChild('target', $target);
        $this->setChild('grantee', $grantee);
        $this->setChild('right', trim($right));
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
     * Gets the right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->getChild('right');
    }

    /**
     * Sets the right.
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        return $this->setChild('right', trim($right));
    }
}
