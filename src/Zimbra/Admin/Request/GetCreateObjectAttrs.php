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
        $this->setChild('target', $target);
        if($domain instanceof Domain)
        {
            $this->setChild('domain', $domain);
        }
        if($cos instanceof Cos)
        {
            $this->setChild('cos', $cos);
        }
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
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain)
    {
        return $this->setChild('domain', $domain);
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
