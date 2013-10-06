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

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\DataSourceSpecifier as DataSource;

/**
 * CreateDataSource class
 * Count number of objects.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDataSource extends Request
{
    /**
     * Id for an existing Account
     * @var string
     */
    private $_id;

    /**
     * Details of data source
     * @var DataSource
     */
    private $_dataSource;

    /**
     * Constructor method for CreateDataSource
     * @param string $id
     * @param DataSource $dataSource
     * @return self
     */
    public function __construct($id, DataSource $dataSource)
    {
        parent::__construct();
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
     * @param  DataSource $dataSource
     * @return DataSource|self
     */
    public function dataSource(DataSource $dataSource = null)
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
        $this->array += $this->_dataSource->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('id', $this->_id);
        $this->xml->append($this->_dataSource->toXml());
        return parent::toXml();
    }
}
