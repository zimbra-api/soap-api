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
 * CreateSystemRetentionPolicy class
 * Create a system retention policy.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateSystemRetentionPolicy extends Request
{
    /**
     * Class of service selector
     * @var Cos
     */
    private $_cos;

    /**
     * Keep policy detail
     * @var Policy
     */
    private $_keep;

    /**
     * Purge policy detail
     * @var Policy
     */
    private $_purge;

    /**
     * Constructor method for CreateSystemRetentionPolicy
     * @param Cos $cos
     * @param Policy $keep
     * @param Policy $purge
     * @return self
     */
    public function __construct(Cos $cos = null, Policy $keep = null, Policy $purge = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
        }
        if($keep instanceof Policy)
        {
            $this->_keep = $keep;
        }
        if($purge instanceof Policy)
        {
            $this->_purge = $purge;
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
            return $this->_cos;
        }
        $this->_cos = $cos;
        return $this;
    }

    /**
     * Gets or sets keep
     *
     * @param  Policy $keep
     * @return Policy|self
     */
    public function keep(Policy $keep = null)
    {
        if(null === $keep)
        {
            return $this->_keep;
        }
        $this->_keep = $keep;
        return $this;
    }

    /**
     * Gets or sets purge
     *
     * @param  Policy $purge
     * @return Policy|self
     */
    public function purge(Policy $purge = null)
    {
        if(null === $purge)
        {
            return $this->_purge;
        }
        $this->_purge = $purge;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_cos instanceof Cos)
        {
            $this->array += $this->_cos->toArray();
        }
        if($this->_keep instanceof Policy)
        {
            $this->array['keep'] = $this->_keep->toArray();
        }
        if($this->_purge instanceof Policy)
        {
            $this->array['purge'] = $this->_purge->toArray();
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
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        if($this->_keep instanceof Policy)
        {
            $keep = $this->xml->addChild('keep', null);
            $keep->append($this->_keep->toXml());
        }
        if($this->_purge instanceof Policy)
        {
            $purge = $this->xml->addChild('purge', null);
            $purge->append($this->_purge->toXml());
        }
        return parent::toXml();
    }
}
