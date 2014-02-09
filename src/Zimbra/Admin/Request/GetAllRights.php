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
            $this->property('targetType', trim($targetType));
        }
        if(null !== $expandAllAttrs)
        {
            $this->property('expandAllAttrs', (bool) $expandAllAttrs);
        }
        if($rightClass instanceof RightClass)
        {
            $this->property('rightClass', $rightClass);
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
            return $this->property('targetType');
        }
        return $this->property('targetType', trim($targetType));
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
            return $this->property('expandAllAttrs');
        }
        return $this->property('expandAllAttrs', (bool) $expandAllAttrs);
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
            return $this->property('rightClass');
        }
        return $this->property('rightClass', $rightClass);
    }
}
