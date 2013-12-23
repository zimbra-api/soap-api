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

use Zimbra\Utils\SimpleXML;
use Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec as DataSource;
use Zimbra\Utils\TypedSequence;

/**
 * SyncGalAccountSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccountSpec
{
    /**
     * Account ID
     * @var string
     */
    private $_id;

    /**
     * SyncGalAccount data source specifications
     * @var TypedSequence
     */
    private $_dataSource = array();

    /**
     * Constructor method for SyncGalAccountSpec
     * @param string $id
     * @param array $dataSources
     * @return self
     */
    public function __construct($id, array $dataSources = array())
    {
        $this->_id = trim($id);
        $this->_dataSource = new TypedSequence(
            'Zimbra\Soap\Struct\SyncGalAccountDataSourceSpec', $dataSources
        );
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
     * Add a data source
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function addDataSource(DataSource $dataSource)
    {
        $this->_dataSource->add($dataSource);
        return $this;
    }

    /**
     * Gets data source equence
     *
     * @return Sequence
     */
    public function dataSource()
    {
        return $this->_dataSource;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'account')
    {
        $name = !empty($name) ? $name : 'account';
        $arr = array(
            'id' => $this->_id,
        );
        if(count($this->_dataSource))
        {
            $arr['datasource'] = array();
            foreach ($this->_dataSource as $dataSource)
            {
                $dataSourceArr = $dataSource->toArray('datasource');
                $arr['datasource'][] = $dataSourceArr['datasource'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'account')
    {
        $name = !empty($name) ? $name : 'account';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        foreach ($this->_dataSource as $dataSource)
        {
            $xml->append($dataSource->toXml('datasource'));
        }
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
