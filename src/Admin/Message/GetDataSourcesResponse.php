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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDataSourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDataSourcesResponse extends SoapResponse
{
    /**
     * Information on data sources
     * 
     * @Accessor(getter="getDataSources", setter="setDataSources")
     * @Type("array<Zimbra\Admin\Struct\DataSourceInfo>")
     * @XmlList(inline=true, entry="dataSource", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getDataSources', setter: 'setDataSources')]
    #[Type('array<Zimbra\Admin\Struct\DataSourceInfo>')]
    #[XmlList(inline: true, entry: 'dataSource', namespace: 'urn:zimbraAdmin')]
    private $dataSources = [];

    /**
     * Constructor
     *
     * @param array $dataSources
     * @return self
     */
    public function __construct(array $dataSources = [])
    {
        $this->setDataSources($dataSources);
    }

    /**
     * Set dataSource informations
     *
     * @param  array $sources
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
