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
		$this->property('type', $type);
		$this->property('by', $by);
    }

    /**
     * Gets or sets type
     *
     * @param  GranteeType $type
     * @return GranteeType|self
     */
    public function type(GranteeType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets by
     *
     * @param  GranteeBy $by
     * @return GranteeBy|self
     */
    public function by(GranteeBy $by = null)
    {
        if(null === $by)
        {
            return $this->property('by');
        }
        return $this->property('by', $by);
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
