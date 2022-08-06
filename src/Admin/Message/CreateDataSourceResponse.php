<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\DataSourceInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateDataSourceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDataSourceResponse extends SoapResponse
{
    /**
     * Details of created data source
     * 
     * @Accessor(getter="getDataSource", setter="setDataSource")
     * @SerializedName("dataSource")
     * @Type("Zimbra\Admin\Struct\DataSourceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?DataSourceInfo $dataSource = NULL;

    /**
     * Constructor
     *
     * @param DataSourceInfo $dataSource
     * @return self
     */
    public function __construct(?DataSourceInfo $dataSource = NULL)
    {
        if ($dataSource instanceof DataSourceInfo) {
            $this->setDataSource($dataSource);
        }
    }

    /**
     * Get the cal resource.
     *
     * @return DataSourceInfo
     */
    public function getDataSource(): ?DataSourceInfo
    {
        return $this->dataSource;
    }

    /**
     * Set the cal resource.
     *
     * @param  DataSourceInfo $dataSource
     * @return self
     */
    public function setDataSource(DataSourceInfo $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }
}
