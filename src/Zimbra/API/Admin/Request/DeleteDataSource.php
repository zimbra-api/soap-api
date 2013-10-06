<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Struct\Id;

/**
 * DeleteDataSource class
 * Deletes the given data source.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteDataSource extends Attr
{
    /**
     * Id for an existing Account
     * @var string
     */
    private $_id;

    /**
     * Data source ID
     * @var Id
     */
    private $_dataSource;

    /**
     * Constructor method for DeleteDataSource
     * @param  string $id
     * @param  Id     $dataSource
     * @param  array  $attrs
     * @return self
     */
    public function __construct($id, Id $dataSource, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_id = trim($id);
        $this->_dataSource = $dataSource;
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets dataSource
     *
     * @param  Id $dataSource
     * @return Id|self
     */
    public function dataSource(Id $dataSource = null)
    {
        if(null === $dataSource)
        {
            return $this->_dataSource;
        }
        $this->_dataSource = $dataSource;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'id' => $this->_id,
        );
        $this->array += $this->_dataSource->toArray('dataSource');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('id', $this->_id)
                  ->append($this->_dataSource->toXml('dataSource'));
        return parent::toXml();
    }
}
