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
use Zimbra\Soap\Request;

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
class CreateSystemRetentionPolicy extends Request
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
            $this->child('cos', $cos);
        }
        if($keep instanceof PolicyHolder)
        {
            $this->child('keep', $keep);
        }
        if($purge instanceof PolicyHolder)
        {
            $this->child('purge', $purge);
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
     * Gets or sets keep
     *
     * @param  PolicyHolder $keep
     * @return PolicyHolder|self
     */
    public function keep(PolicyHolder $keep = null)
    {
        if(null === $keep)
        {
            return $this->child('keep');
        }
        return $this->child('keep', $keep);
    }

    /**
     * Gets or sets purge
     *
     * @param  PolicyHolder $purge
     * @return PolicyHolder|self
     */
    public function purge(PolicyHolder $purge = null)
    {
        if(null === $purge)
        {
            return $this->child('purge');
        }
        return $this->child('purge', $purge);
    }
}
