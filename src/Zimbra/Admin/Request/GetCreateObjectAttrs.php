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
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\TargetWithType as Target;

/**
 * GetCreateObjectAttrs request class
 * Returns attributes, with defaults and constraints if any, that can be set by the authed admin when an object is created.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrs extends Base
{
    /**
     * Constructor method for GetCreateObjectAttrs
     * @param  Target $target
     * @param  Domain $domain
     * @param  Cos $cos
     * @return self
     */
    public function __construct(Target $target, Domain $domain = null, Cos $cos = null)
    {
        parent::__construct();
        $this->child('target', $target);
        if($domain instanceof Domain)
        {
            $this->child('domain', $domain);
        }
        if($cos instanceof Cos)
        {
            $this->child('cos', $cos);
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
     * Gets or sets domain
     *
     * @param  Domain $domain
     * @return Domain|self
     */
    public function domain(Domain $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
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
}
