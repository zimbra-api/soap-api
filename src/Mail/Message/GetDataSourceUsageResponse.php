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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDataSourceUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDataSourceUsageResponse extends SoapResponse
{
    /**
     * GetDataSourceUsage data
     * 
     * @Accessor(getter="getUsages", setter="setUsages")
     * @Type("array<Zimbra\Mail\Struct\DataSourceUsage>")
     * @XmlList(inline=true, entry="dataSourceUsage", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUsages', setter: 'setUsages')]
    #[Type('array<Zimbra\Mail\Struct\DataSourceUsage>')]
    #[XmlList(inline: true, entry: 'dataSourceUsage', namespace: 'urn:zimbraMail')]
    private $usages = [];

    /**
     * @Accessor(getter="getDataSourceQuota", setter="setDataSourceQuota")
     * @SerializedName("dsQuota")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var int
     */
    #[Accessor(getter: 'getDataSourceQuota', setter: 'setDataSourceQuota')]
    #[SerializedName('dsQuota')]
    #[Type('int')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $dataSourceQuota;

    /**
     * @Accessor(getter="getDataSourceTotalQuota", setter="setDataSourceTotalQuota")
     * @SerializedName("dsTotalQuota")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var int
     */
    #[Accessor(getter: 'getDataSourceTotalQuota', setter: 'setDataSourceTotalQuota')]
    #[SerializedName('dsTotalQuota')]
    #[Type('int')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $totalQuota;

    /**
     * Constructor
     *
     * @param  array $usages
     * @return self
     */
    public function __construct(
        int $dataSourceQuota = 0, int $totalQuota = 0, array $usages = []
    )
    {
        $this->setDataSourceQuota($dataSourceQuota)
             ->setDataSourceTotalQuota($totalQuota)
             ->setUsages($usages);
    }

    /**
     * Set usages
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
     * Get usages
     *
     * @return array
     */
    public function getUsages(): array
    {
        return $this->usages;
    }

    /**
     * Set dataSourceQuota
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
     * Get dataSourceQuota
     *
     * @return int
     */
    public function getDataSourceQuota(): ?int
    {
        return $this->dataSourceQuota;
    }

    /**
     * Set totalQuota
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
     * Get totalQuota
     *
     * @return int
     */
    public function getDataSourceTotalQuota(): ?int
    {
        return $this->totalQuota;
    }
}
