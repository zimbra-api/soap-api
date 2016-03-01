<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as GranteeBy;
use Zimbra\Struct\Base;

/**
 * DistributionListGranteeSelector struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListGranteeSelector extends Base
{
    /**
     * Constructor method for DistributionListGranteeSelector
     * @param GranteeType $type
     * @param GranteeBy $by
     * @param string $value
     * @return self
     */
    public function __construct(GranteeType $type, GranteeBy $by, $value = null)
    {
		parent::__construct(trim($value));
		$this->setProperty('type', $type);
		$this->setProperty('by', $by);
    }

    /**
     * Gets grantee type
     *
     * @return GranteeType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets grantee type
     *
     * @param  GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets grantee by
     *
     * @return GranteeBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets grantee by
     *
     * @param  GranteeBy $by
     * @return self
     */
    public function setBy(GranteeBy $by = null)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grantee')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grantee')
    {
        return parent::toXml($name);
    }
}
