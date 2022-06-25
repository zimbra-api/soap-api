<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Mail\Struct\DataSourceUsage;
use Zimbra\Soap\ResponseInterface;

/**
 * GetDataSourceUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDataSourceUsageResponse implements ResponseInterface
{
    /**
     * GetDataSourceUsage data
     * 
     * @Accessor(getter="getUsages", setter="setUsages")
     * @SerializedName("dataSourceUsage")
     * @Type("array<Zimbra\Mail\Struct\DataSourceUsage>")
     * @XmlList(inline=true, entry="dataSourceUsage")
     */
    private $usages = [];

    /**
     * @Accessor(getter="getDataSourceQuota", setter="setDataSourceQuota")
     * @SerializedName("dsQuota")
     * @Type("integer")
     * @XmlElement(cdata=false)
     */
    private $dataSourceQuota;

    /**
     * @Accessor(getter="getDataSourceTotalQuota", setter="setDataSourceTotalQuota")
     * @SerializedName("dsTotalQuota")
     * @Type("integer")
     * @XmlElement(cdata=false)
     */
    private $totalQuota;

    /**
     * Constructor method for GetDataSourceUsageResponse
     *
     * @param  array $usages
     * @return self
     */
    public function __construct(
        int $dataSourceQuota, int $totalQuota, array $usages = []
    )
    {
        $this->setDataSourceQuota($dataSourceQuota)
             ->setDataSourceTotalQuota($totalQuota)
             ->setUsages($usages);
    }

    /**
     * Add usage
     *
     * @param  DataSourceUsage $usage
     * @return self
     */
    public function addDataSourceUsage(DataSourceUsage $usage): self
    {
        $this->usages[] = $usage;
        return $this;
    }

    /**
     * Sets usages
     *
     * @param  array $usages
     * @return self
     */
    public function setUsages(array $usages): self
    {
        $this->usages = array_filter($usages, static fn ($usage) => $usage instanceof DataSourceUsage);
        return $this;
    }

    /**
     * Gets usages
     *
     * @return array
     */
    public function getUsages(): array
    {
        return $this->usages;
    }

    /**
     * Sets dataSourceQuota
     *
     * @param  int $dataSourceQuota
     * @return self
     */
    public function setDataSourceQuota(int $dataSourceQuota): self
    {
        $this->dataSourceQuota = $dataSourceQuota;
        return $this;
    }

    /**
     * Gets dataSourceQuota
     *
     * @return int
     */
    public function getDataSourceQuota(): ?int
    {
        return $this->dataSourceQuota;
    }

    /**
     * Sets totalQuota
     *
     * @param  int $totalQuota
     * @return self
     */
    public function setDataSourceTotalQuota(int $totalQuota): self
    {
        $this->totalQuota = $totalQuota;
        return $this;
    }

    /**
     * Gets totalQuota
     *
     * @return int
     */
    public function getDataSourceTotalQuota(): ?int
    {
        return $this->totalQuota;
    }
}
