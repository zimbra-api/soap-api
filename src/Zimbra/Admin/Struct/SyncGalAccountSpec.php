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

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec as DataSource;
use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * SyncGalAccountSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccountSpec extends Base
{
    /**
     * SyncGalAccount data source specifications
     * @var TypedSequence<DataSource>
     */
    private $_dataSource;

    /**
     * Constructor method for SyncGalAccountSpec
     * @param string $id Account ID
     * @param array $dataSources SyncGalAccount data source specifications
     * @return self
     */
    public function __construct($id, array $dataSources = [])
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setDataSources($dataSources);

        $this->on('before', function(Base $sender)
        {
            if($sender->getDataSources()->count())
            {
                $sender->setChild('datasource', $sender->getDataSources()->all());
            }
        });
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
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
     * Sets data source sequence
     *
     * @param array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources)
    {
        $this->_dataSource = new TypedSequence(
            'Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec', $dataSources
        );
        return $this;
    }

    /**
     * Gets data source sequence
     *
     * @return Sequence
     */
    public function getDataSources()
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
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'account')
    {
        return parent::toXml($name);
    }
}
