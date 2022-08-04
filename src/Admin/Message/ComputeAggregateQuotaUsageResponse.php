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
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo as QuotaInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ComputeAggregateQuotaUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ComputeAggregateQuotaUsageResponse extends SoapResponse
{
    /**
     * Aggregate quota information for domain
     * 
     * @Accessor(getter="getDomainQuotas", setter="setDomainQuotas")
     * @Type("array<Zimbra\Admin\Struct\DomainAggregateQuotaInfo>")
     * @XmlList(inline=true, entry="domain", namespace="urn:zimbraAdmin")
     */
    private $domainQuotas = [];

    /**
     * Constructor method for ComputeAggregateQuotaUsageResponse
     *
     * @param array $domainQuotas
     * @return self
     */
    public function __construct(array $domainQuotas = [])
    {
        $this->setDomainQuotas($domainQuotas);
    }

    /**
     * Add a domain quota
     *
     * @param  QuotaInfo $domainQuota
     * @return self
     */
    public function addDomainQuota(QuotaInfo $domainQuota): self
    {
        $this->domainQuotas[] = $domainQuota;
        return $this;
    }

    /**
     * Set domain quotas
     *
     * @param  array $quotas
     * @return self
     */
    public function setDomainQuotas(array $quotas): self
    {
        $this->domainQuotas = array_filter($quotas, static fn ($quota) => $quota instanceof QuotaInfo);
        return $this;
    }

    /**
     * Get domain quotas
     *
     * @return array
     */
    public function getDomainQuotas(): array
    {
        return $this->domainQuotas;
    }
}
