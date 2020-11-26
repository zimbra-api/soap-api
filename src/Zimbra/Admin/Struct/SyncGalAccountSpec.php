<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec as DataSource;

/**
 * SyncGalAccountSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="account")
 */
class SyncGalAccountSpec
{
    /**
     * Account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * SyncGalAccount data source specifications
     * @Accessor(getter="getDataSources", setter="setDataSources")
     * @SerializedName("datasource")
     * @Type("array<Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec>")
     * @XmlList(inline = true, entry = "datasource")
     */
    private $dataSources;

    /**
     * Constructor method for SyncGalAccountSpec
     * @param string $id
     * @param array $dataSources
     * @return self
     */
    public function __construct(string $id, array $dataSources = [])
    {
        $this->setId($id)
             ->setDataSources($dataSources);
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Add a data source
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function addDataSource(DataSource $dataSource): self
    {
        $this->dataSources[] = $dataSource;
        return $this;
    }

    /**
     * Sets data source sequence
     *
     * @param array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources): self
    {
        $this->dataSources = [];
        foreach ($dataSources as $dataSource) {
            if ($dataSource instanceof DataSource) {
                $this->dataSources[] = $dataSource;
            }
        }
        return $this;
    }

    /**
     * Gets data source sequence
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return $this->dataSources;
    }
}
