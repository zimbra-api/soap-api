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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec as DataSource;

/**
 * SyncGalAccountSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="account")
 */
class SyncGalAccountSpec
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * SyncGalAccount data source specifications
     * @Accessor(getter="getDataSources", setter="setDataSources")
     * @Type("array<Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec>")
     * @XmlList(inline = true, entry = "datasource")
     */
    private $_dataSources;

    /**
     * Constructor method for SyncGalAccountSpec
     * @param string $id Account ID
     * @param array $dataSources SyncGalAccount data source specifications
     * @return self
     */
    public function __construct($id, array $dataSources = [])
    {
        $this->setId($id)
             ->setDataSources($dataSources);
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
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
        $this->_dataSources[] = $dataSource;
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
        $this->_dataSources = [];
        foreach ($dataSources as $dataSource) {
            if ($dataSource instanceof DataSource) {
                $this->_dataSources[] = $dataSource;
            }
        }
        return $this;
    }

    /**
     * Gets data source sequence
     *
     * @return array
     */
    public function getDataSources()
    {
        return $this->_dataSources;
    }
}
