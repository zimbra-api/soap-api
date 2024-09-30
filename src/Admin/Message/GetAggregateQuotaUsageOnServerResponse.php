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
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAggregateQuotaUsageOnServerResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAggregateQuotaUsageOnServerResponse extends SoapResponse
{
    /**
     * Aggregate quota information reported per domain
     *
     * @Accessor(getter="getDomainQuotas", setter="setDomainQuotas")
     * @Type("array<Zimbra\Admin\Struct\DomainAggregateQuotaInfo>")
     * @XmlList(inline=true, entry="domain", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getDomainQuotas", setter: "setDomainQuotas")]
    #[Type("array<Zimbra\Admin\Struct\DomainAggregateQuotaInfo>")]
    #[XmlList(inline: true, entry: "domain", namespace: "urn:zimbraAdmin")]
    private $domainQuotas = [];

    /**
     * Constructor
     *
     * @param array $domainQuotas
     * @return self
     */
    public function __construct(array $domainQuotas = [])
    {
        $this->setDomainQuotas($domainQuotas);
    }

    /**
     * Set quota informations
     *
     * @param  array $quotas
     * @return self
     */
    public function setDomainQuotas(array $quotas): self
    {
        $this->domainQuotas = array_filter(
            $quotas,
            static fn($quota) => $quota instanceof DomainAggregateQuotaInfo
        );
        return $this;
    }

    /**
     * Get quota informations
     *
     * @return array
     */
    public function getDomainQuotas(): array
    {
        return $this->domainQuotas;
    }
}
