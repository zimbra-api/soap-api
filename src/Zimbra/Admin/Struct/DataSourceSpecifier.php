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

use Zimbra\Enum\DataSourceType;

/**
 * DataSourceSpecifier struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DataSourceSpecifier extends AdminAttrsImpl
{
    /**
     * Constructor method for DataSourceSpecifier
     * @param DataSourceType $type Data source type
     * @param string $name Data source name
     * @param array $attrs Attributes
     * @return self
     */
    public function __construct(DataSourceType $type, $name, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->property('type', $type);
        $this->property('name', trim($name));
    }

    /**
     * Gets or sets type
     *
     * @param  DataSourceType $type
     * @return DataSourceType|self
     */
    public function type(DataSourceType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'dataSource')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'dataSource')
    {
        return parent::toXml($name);
    }
}
