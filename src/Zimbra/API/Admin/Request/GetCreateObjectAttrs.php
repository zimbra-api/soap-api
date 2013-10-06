<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\TargetWithType as Target;
use Zimbra\Soap\Struct\CosSelector as Cos;
use Zimbra\Soap\Struct\DomainSelector as Domain;

/**
 * GetCreateObjectAttrs class
 * Returns attributes, with defaults and constraints if any, that can be set by the authed admin when an object is created.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrs extends Request
{
    /**
     * Target
     * @var Target
     */
    private $_target;

    /**
     * Domain
     * @var Domain
     */
    private $_domain;

    /**
     * Cos
     * @var Cos
     */
    private $_cos;

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
        $this->_target = $target;
        if($domain instanceof Domain)
        {
            $this->_domain = $domain;
        }
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
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
            return $this->_target;
        }
        $this->_target = $target;
        return $this;
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
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
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
            return $this->_cos;
        }
        $this->_cos = $cos;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_target->toArray();
        if($this->_domain instanceof Domain)
        {
            $this->array += $this->_domain->toArray();
        }
        if($this->_cos instanceof Cos)
        {
            $this->array += $this->_cos->toArray();
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_target->toXml());
        if($this->_domain instanceof Domain)
        {
            $this->xml->append($this->_domain->toXml());
        }
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        return parent::toXml();
    }
}
