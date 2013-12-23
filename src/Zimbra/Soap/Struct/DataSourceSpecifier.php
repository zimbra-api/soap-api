<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\DataSourceType;
use Zimbra\Utils\SimpleXML;

/**
 * DataSourceSpecifier class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DataSourceSpecifier extends AttrsImpl
{
    /**
     * The type
     * @var DataSourceType
     */
    private $type;

    /**
     * The name
     * - use : required
     * @var string
     */
    private $name;

    /**
     * Constructor method for DataSourceSpecifier
     * @param DataSourceType $type
     * @param string $name
     * @return self
     */
    public function __construct(DataSourceType $type, $name, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_type = $type;
        $this->_name = trim($name);
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
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'dataSource')
    {
        $name = !empty($name) ? $name : 'dataSource';
        $this->array = array(
            'type' => (string) $this->_type,
            'name' => $this->_name,
        );
        return array($name => parent::toArray());
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'dataSource')
    {
        $name = !empty($name) ? $name : 'dataSource';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('type', (string) $this->_type)
            ->addAttribute('name', $this->_name);
        parent::appendAttrs($xml);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
