<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\TargetSpec;

/**
 * CheckPermission request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckPermission extends Request
{
    /**
     * Target specification
     * @var TargetSpec
     */
    private $_target;

    /**
     * Rights to check
     * @var array
     */
    private $_right;

    /**
     * Constructor method for CheckPermission
     * @param  TargetSpec $target
     * @param  array $right
     * @return self
     */
    public function __construct(TargetSpec $target = null, array $right = array())
    {
        parent::__construct();
        if($target instanceof TargetSpec)
        {
            $this->_target = $target;
        }
        $this->_right = array();
        foreach ($right as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_right))
            {
                $this->_right[] = $value;
            }
        }
    }

    /**
     * Get or set target
     *
     * @param  TargetSpec $target
     * @return TargetSpec|self
     */
    public function target(TargetSpec $target = null)
    {
        if(null === $target)
        {
            return $this->_target;
        }
        $this->_target = $target;
        return $this;
    }

    /**
     * Get or set right
     *
     * @param  array $right
     * @return array|self
     */
    public function right(array $right = null)
    {
        if(null === $right)
        {
            return $this->_right;
        }
        $this->_right = array();
        foreach ($right as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_right))
            {
                $this->_right[] = $value;
            }
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
        if($this->_target instanceof TargetSpec)
        {
            $this->array += $this->_target->toArray('target');
        }
        if(count($this->_right))
        {
            $this->array['right'] = $this->_right;
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
        if($this->_target instanceof TargetSpec)
        {
            $this->xml->append($this->_target->toXml('target'));
        }
        if(count($this->_right))
        {
            foreach ($this->_right as $right)
            {
                $this->xml->addChild('right', $right);
            }
        }
        return parent::toXml();
    }
}
