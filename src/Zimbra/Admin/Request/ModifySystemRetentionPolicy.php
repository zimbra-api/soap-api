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

use Zimbra\Admin\Struct\CosSelector as Cos;
use Zimbra\Admin\Struct\Policy;

/**
 * ModifySystemRetentionPolicy request class
 * Modify system retention policy.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySystemRetentionPolicy extends Base
{
    /**
     * Constructor method for ModifySystemRetentionPolicy
     * @param Policy $policy New policy
     * @param Cos $cos Class of service selector
     * @return self
     */
    public function __construct(Policy $policy, Cos $cos = null)
    {
        parent::__construct();
        $this->child('policy', $policy);
        if($cos instanceof Cos)
        {
            $this->child('cos', $cos);
        }
    }

    /**
     * Gets or sets cos
     *
     * @param  Cos $cos
     * @return Cos|self
     */
    public function cos(Cos $cos = null)
    {
        if(null === $cos)
        {
            return $this->child('cos');
        }
        return $this->child('cos', $cos);
    }

    /**
     * Gets or sets policy
     *
     * @param  Policy $policy
     * @return Policy|self
     */
    public function policy(Policy $policy = null)
    {
        if(null === $policy)
        {
            return $this->child('policy');
        }
        return $this->child('policy', $policy);
    }
}
