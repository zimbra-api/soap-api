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
use Zimbra\Soap\Enum\RightClass;

/**
 * GetAllRights class
 * Get all system defined rights.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllRights extends Request
{
    /**
     * Target type on which a right is grantable
     * @var string
     */
    private $_targetType;

    /**
     * Flags whether to include all attribute names in the <attrs> elements in GetRightResponse if the right is meant for all attributes
     * @var bool
     */
    private $_expandAllAttrs;

    /**
     * Right class to return
     * ADMIN: return admin rights only
     * USER: return user rights only
     * ALL: return both admin rights and user rights
     * @var RightClass
     */
    private $_rightClass;

    /**
     * Constructor method for GetAllRights
     * @param  string $targetType
     * @param  bool $expandAllAttrs
     * @param  RightClass $rightClass
     * @return self
     */
    public function __construct($targetType = null, $expandAllAttrs = null, RightClass $rightClass = null)
    {
        parent::__construct();
		$this->_targetType = trim($targetType);
        if(null !== $expandAllAttrs)
        {
            $this->_expandAllAttrs = (bool) $expandAllAttrs;
        }
        if($rightClass instanceof RightClass)
        {
            $this->_rightClass = $rightClass;
        }
    }

    /**
     * Gets or sets targetType
     *
     * @param  string $targetType
     * @return string|self
     */
    public function targetType($targetType = null)
    {
        if(null === $targetType)
        {
            return $this->_targetType;
        }
        $this->_targetType = trim($targetType);
        return $this;
    }

    /**
     * Gets or sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return bool|self
     */
    public function expandAllAttrs($expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->_expandAllAttrs;
        }
        $this->_expandAllAttrs = (bool) $expandAllAttrs;
        return $this;
    }

    /**
     * Gets or sets rightClass
     *
     * @param  RightClass $rightClass
     * @return RightClass|self
     */
    public function rightClass(RightClass $rightClass = null)
    {
        if(null === $rightClass)
        {
            return $this->_rightClass;
        }
		$this->_rightClass = $rightClass;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_targetType))
        {
            $this->array['targetType'] = $this->_targetType;
        }
        if(is_bool($this->_expandAllAttrs))
        {
            $this->array['expandAllAttrs'] = $this->_expandAllAttrs ? 1 : 0;
        }
        if($this->_rightClass instanceof RightClass)
        {
            $this->array['rightClass'] = (string) $this->_rightClass;
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
        if(!empty($this->_targetType))
        {
            $this->xml->addAttribute('targetType', $this->_targetType);
        }
        if(is_bool($this->_expandAllAttrs))
        {
            $this->xml->addAttribute('expandAllAttrs', $this->_expandAllAttrs ? 1 : 0);
        }
        if($this->_rightClass instanceof RightClass)
        {
            $this->xml->addAttribute('rightClass', (string) $this->_rightClass);
        }
        return parent::toXml();
    }
}
