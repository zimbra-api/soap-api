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
        $this->setChild('policy', $policy);
        if($cos instanceof Cos)
        {
            $this->setChild('cos', $cos);
        }
    }

    /**
     * Gets the policy.
     *
     * @return Policy
     */
    public function getPolicy()
    {
        return $this->getChild('policy');
    }

    /**
     * Sets the policy.
     *
     * @param  Policy $policy
     * @return self
     */
    public function setPolicy(Policy $policy)
    {
        return $this->setChild('policy', $policy);
    }

    /**
     * Gets the cos.
     *
     * @return Cos
     */
    public function getCos()
    {
        return $this->getChild('cos');
    }

    /**
     * Sets the cos.
     *
     * @param  Cos $cos
     * @return self
     */
    public function setCos(Cos $cos)
    {
        return $this->setChild('cos', $cos);
    }
}
