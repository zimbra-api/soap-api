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
        array $attrs = array())
    {
        parent::__construct($attrs);
        $this->child('target', $target);
        $this->child('grantee', $grantee);
        $this->child('right', trim($right));
    }

    /**
     * Gets or sets target
     *
     * @param  Target $action
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
     * @param  Grantee $action
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
     * @param  string $action
     * @return string|self
     */
    public function right($right = null)
    {
        if(null === $right)
        {
            return $this->child('right');
        }
        return $this->child('right', trim($right));
    }
}
