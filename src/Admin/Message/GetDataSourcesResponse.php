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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\DataSourceInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetDataSourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDataSourcesResponse implements SoapResponseInterface
{
    /**
     * Information on data sources
     * 
     * @Accessor(getter="getDataSources", setter="setDataSources")
     * @Type("array<Zimbra\Admin\Struct\DataSourceInfo>")
     * @XmlList(inline=true, entry="dataSource", namespace="urn:zimbraAdmin")
     */
    private $dataSources = [];

    /**
     * Constructor method for GetDataSourcesResponse
     *
     * @param array $dataSources
     * @return self
     */
    public function __construct(array $dataSources = [])
    {
        $this->setDataSources($dataSources);
    }

    /**
     * Add a dataSource information
     *
     * @param  DataSourceInfo $dataSource
     * @return self
     */
    public function addDataSource(DataSourceInfo $dataSource): self
    {
        $this->dataSources[] = $dataSource;
        return $this;
    }

    /**
     * Set dataSource informations
     *
     * @param  array $dataSources
     * @return self
     */
    public function setDataSources(array $sources): self
    {
        $this->dataSources = array_filter($sources, static fn ($source) => $source instanceof DataSourceInfo);
        return $this;
    }

    /**
     * Get dataSource informations
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return $this->dataSources;
    }
}
