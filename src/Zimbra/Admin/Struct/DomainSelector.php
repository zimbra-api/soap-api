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

use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Base;

/**
 * DomainSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DomainSelector extends Base
{
    /**
     * Constructor method for DomainSelector
     * @param  DomainBy $by Select the meaning of {acct-selector-key}
     * @param  string $value The key used to identify the domain
     * @return self
     */
    public function __construct(DomainBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->property('by', $by);
    }

    /**
     * Gets or sets by
     *
     * @param  DomainBy $by
     * @return DomainBy|self
     */
    public function by(DomainBy $by = null)
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
    public function toArray($name = 'domain')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'domain')
    {
        return parent::toXml($name);
    }
}
