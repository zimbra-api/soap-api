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
use Zimbra\Soap\Struct\CosSelector as Cos;
use Zimbra\Soap\Struct\Policy;

/**
 * DeleteSystemRetentionPolicy class
 * Delete a system retention policy.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteSystemRetentionPolicy extends Request
{
    /**
     * Details of policy
     * @var Policy
     */
    private $_policy;

    /**
     * Class of service selector
     * @var Cos
     */
    private $_cos;

    /**
     * Constructor method for DeleteSystemRetentionPolicy
     * @param Policy $policy
     * @param Cos $cos
     * @return self
     */
    public function __construct(Policy $policy, Cos $cos = null)
    {
        parent::__construct();
        $this->_policy = $policy;
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
        }
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
            return $this->_policy;
        }
        $this->_policy = $policy;
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
        $this->array = $this->_policy->toArray();
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
        $this->xml->append($this->_policy->toXml());
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        return parent::toXml();
    }
}
