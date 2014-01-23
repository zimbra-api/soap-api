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

use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Struct\Base;

/**
 * DistributionListSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListSelector extends Base
{
    /**
     * Constructor method for DistributionListSelector
     * @param  DLBy $by Select the meaning of {dl-selector-key}
     * @param  string $value Identifies the distribution list to act upon
     * @return self
     */
    public function __construct(DLBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->property('by', $by);
    }

    /**
     * Gets or sets by
     *
     * @param  DLBy $by
     * @return DLBy|self
     */
    public function by(DLBy $by = null)
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
     * @return array
     */
    public function toArray($name = 'dl')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'dl')
    {
        return parent::toXml($name);
    }
}
