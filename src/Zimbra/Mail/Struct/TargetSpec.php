<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copytype and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Base;

/**
 * TargetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TargetSpec extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param TargetType $type Target type
     * @param AccountBy $by Select the meaning of {target-selector-key}
     * @param string $value The key used to identify the target
     * @return self
     */
    public function __construct(
        TargetType $type,
        AccountBy $by,
        $value = null
    )
    {
        parent::__construct(trim($value));
        $this->setProperty('type', $type);
        $this->setProperty('by', $by);
    }

    /**
     * Gets target type
     *
     * @return TargetType
     */
    public function getTargetType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setTargetType(TargetType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets account by
     *
     * @return AccountBy
     */
    public function getAccountBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets account by
     *
     * @param  AccountBy $by
     * @return self
     */
    public function setAccountBy(AccountBy $by)
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'target')
    {
        return parent::toXml($name);
    }
}
