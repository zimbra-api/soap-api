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
use Zimbra\Soap\Request;

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
class GetGrants extends Request
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
            $this->child('target', $target);
        }
        if($grantee instanceof Grantee)
        {
            $this->child('grantee', $grantee);
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
}
