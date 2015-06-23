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
     * @param Zimbra\Enum\DataSourceType $type Data source type
     * @param string $name Data source name
     * @param array $attrs Attributes
     * @return self
     */
    public function __construct(DataSourceType $type, $name, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('type', $type);
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets data source type
     *
     * @return Zimbra\Enum\DataSourceType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets data source type
     *
     * @param  Zimbra\Enum\DataSourceType $type
     * @return self
     */
    public function setType(DataSourceType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets data source name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets data source name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
