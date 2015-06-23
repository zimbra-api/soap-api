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
use Zimbra\Admin\Struct\PolicyHolder;

/**
 * CreateSystemRetentionPolicy request class
 * Create a system retention policy.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateSystemRetentionPolicy extends Base
{
    /**
     * Constructor method for CreateSystemRetentionPolicy
     * @param Cos $cos Class of service selector
     * @param PolicyHolder $keep Keep policy detail
     * @param PolicyHolder $purge Purge policy detail
     * @return self
     */
    public function __construct(
        Cos $cos = null,
        PolicyHolder $keep = null,
        PolicyHolder $purge = null
    )
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->setChild('cos', $cos);
        }
        if($keep instanceof PolicyHolder)
        {
            $this->setChild('keep', $keep);
        }
        if($purge instanceof PolicyHolder)
        {
            $this->setChild('purge', $purge);
        }
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

    /**
     * Gets the keep keep policy.
     *
     * @return PolicyHolder
     */
    public function getKeepPolicy()
    {
        return $this->getChild('keep');
    }

    /**
     * Sets the keep policy.
     *
     * @param  PolicyHolder $keep
     * @return self
     */
    public function setKeepPolicy(PolicyHolder $keep)
    {
        return $this->setChild('keep', $keep);
    }

    /**
     * Gets the purge policy.
     *
     * @return PolicyHolder
     */
    public function getPurgePolicy()
    {
        return $this->getChild('purge');
    }

    /**
     * Sets the purge policy.
     *
     * @param  PolicyHolder $purge
     * @return self
     */
    public function setPurgePolicy(PolicyHolder $purge)
    {
        return $this->setChild('purge', $purge);
    }
}
