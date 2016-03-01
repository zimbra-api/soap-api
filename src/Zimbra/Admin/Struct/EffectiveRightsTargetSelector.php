<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;
use Zimbra\Struct\Base;

/**
 * EffectiveRightsTargetSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class EffectiveRightsTargetSelector extends Base
{
    /**
     * Constructor method for EffectiveRightsTargetSelector
     * @param TargetType $type Target type
     * @param TargetBy $by Target by
     * @param string $value The value
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by = null, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('type', $type);
        if ($by instanceof TargetBy)
        {
            $this->setProperty('by', $by);
        }
    }

    /**
     * Gets type enum
     *
     * @return Zimbra\Enum\TargetType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type enum
     *
     * @param  Zimbra\Enum\TargetType $type
     * @return self
     */
    public function setType(TargetType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\TargetBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\TargetBy $by
     * @return self
     */
    public function setBy(TargetBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'target')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'target')
    {
        return parent::toXml($name);
    }
}
