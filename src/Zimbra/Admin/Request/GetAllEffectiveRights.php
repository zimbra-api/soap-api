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

use Zimbra\Admin\Struct\GranteeSelector as Grantee;

/**
 * GetAllEffectiveRights request class
 * Get all effective Admin rights.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllEffectiveRights extends Base
{
    /**
     * Constructor method for GetAllEffectiveRights
     * @param  Grantee $grantee Grantee
     * @param  bool $expandAllAttrs Flags whether to include all attribute names if the right is meant for all attributes
     * @return self
     */
    public function __construct(Grantee $grantee = null, $expandAllAttrs = null)
    {
        parent::__construct();
        if($grantee instanceof Grantee)
        {
            $this->child('grantee', $grantee);
        }
        if(null !== $expandAllAttrs)
        {
            $this->property('expandAllAttrs', (bool) $expandAllAttrs);
        }
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
    public function expandAllAttrs($expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->property('expandAllAttrs');
        }
        return $this->property('expandAllAttrs', (bool) $expandAllAttrs);
    }
}
