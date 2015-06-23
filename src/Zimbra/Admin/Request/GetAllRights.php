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

use Zimbra\Enum\RightClass;

/**
 * GetAllRights request class
 * Get all system defined rights.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllRights extends Base
{
    /**
     * Constructor method for GetAllRights
     * @param  string $targetType Target type on which a right is grantable
     * @param  bool $expandAllAttrs Flags whether to include all attribute names in the <attrs> elements in GetRightResponse if the right is meant for all attributes
     * @param  RightClass $rightClass Right class to return
     * @return self
     */
    public function __construct($targetType = null, $expandAllAttrs = null, RightClass $rightClass = null)
    {
        parent::__construct();
        if(null !== $targetType)
        {
            $this->setProperty('targetType', trim($targetType));
        }
        if(null !== $expandAllAttrs)
        {
            $this->setProperty('expandAllAttrs', (bool) $expandAllAttrs);
        }
        if($rightClass instanceof RightClass)
        {
            $this->setProperty('rightClass', $rightClass);
        }
    }

    /**
     * Gets targetType
     *
     * @return string
     */
    public function getTargetType()
    {
        return $this->getProperty('targetType');
    }

    /**
     * Sets targetType
     *
     * @param  string $targetType
     * @return self
     */
    public function setTargetType($targetType)
    {
        return $this->setProperty('targetType', trim($targetType));
    }

    /**
     * Gets expandAllAttrs
     *
     * @return bool
     */
    public function getExpandAllAttrs()
    {
        return $this->getProperty('expandAllAttrs');
    }

    /**
     * Sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs($expandAllAttrs)
    {
        return $this->setProperty('expandAllAttrs', (bool) $expandAllAttrs);
    }

    /**
     * Gets rightClass
     *
     * @return RightClass
     */
    public function getRightClass()
    {
        return $this->getProperty('rightClass');
    }

    /**
     * Sets rightClass
     *
     * @param  RightClass $rightClass
     * @return self
     */
    public function setRightClass(RightClass $rightClass)
    {
        return $this->setProperty('rightClass', $rightClass);
    }
}
