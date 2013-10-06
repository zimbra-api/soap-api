<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CheckRightsTargetSpec as Target;

/**
 * CheckRights class
 * Check if the authed user has the specified right(s) on a target.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRights extends Request
{
    /**
     * The targets
     * - maxOccurs : unbounded
     * @var array
     */
    private $_targets = array();

    /**
     * Constructor method for checkRightsRequest
     * @param array $targets
     * @return self
     */
    public function __construct(array $targets)
    {
        parent::__construct();
        $this->targets($targets);
        if(count($this->_targets) === 0)
        {
            throw new \InvalidArgumentException('CheckRights must have at least one target');
        }
    }

    /**
     * Add a target
     *
     * @param  CheckRightsTargetSpec $target
     * @return self
     */
    public function addTarget(Target $target)
    {
        $this->_targets[] = $target;
        return $this;
    }

    /**
     * Gets or sets targets
     *
     * @param  array $targets
     * @return array|self
     */
    public function targets(array $targets = null)
    {
        if(null === $targets)
        {
            return $this->_targets;
        }
        $this->_targets = array();
        foreach ($targets as $target)
        {
            if($target instanceof Target)
            {
                $this->_targets[] = $target;
            }
        }
        if(count($this->_targets) === 0)
        {
            throw new \InvalidArgumentException('CheckRights must have at least one target');
        }
        return $this;        
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array();
        if(count($this->_targets))
        {
            $this->array['target'] = array();
            foreach ($this->_targets as $target)
            {
                $targetArr = $target->toArray();
                $this->array['target'][] = $targetArr['target'];
            }
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
        foreach ($this->_targets as $target)
        {
            $this->xml->append($target->toXml());
        }
        return parent::toXml();
    }
}
