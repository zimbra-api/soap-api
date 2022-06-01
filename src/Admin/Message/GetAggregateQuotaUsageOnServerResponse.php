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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAggregateQuotaUsageOnServerResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAggregateQuotaUsageOnServerResponse implements ResponseInterface
{
    /**
     * Aggregate quota information reported per domain
     * 
     * @Accessor(getter="getDomainQuotas", setter="setDomainQuotas")
     * @SerializedName("domain")
     * @Type("array<Zimbra\Admin\Struct\DomainAggregateQuotaInfo>")
     * @XmlList(inline = true, entry = "domain")
     */
    private $domainQuotas = [];

    /**
     * Constructor method for GetAggregateQuotaUsageOnServerResponse
     *
     * @param array $domainQuotas
     * @return self
     */
    public function __construct(array $domainQuotas = [])
    {
        $this->setDomainQuotas($domainQuotas);
    }

    /**
     * Add a quota information
     *
     * @param  DomainAggregateQuotaInfo $quota
     * @return self
     */
    public function addDomainQuota(DomainAggregateQuotaInfo $quota): self
    {
        $this->domainQuotas[] = $quota;
        return $this;
    }

    /**
     * Sets quota informations
     *
     * @param  array $domainQuotas
     * @return self
     */
    public function setDomainQuotas(array $domainQuotas): self
    {
        $this->domainQuotas = [];
        foreach ($domainQuotas as $quota) {
            if ($quota instanceof DomainAggregateQuotaInfo) {
                $this->domainQuotas[] = $quota;
            }
        }
        return $this;
    }

    /**
     * Gets quota informations
     *
     * @return array
     */
    public function getDomainQuotas(): array
    {
        return $this->domainQuotas;
    }
}
