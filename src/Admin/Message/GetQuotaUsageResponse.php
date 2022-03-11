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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\AccountQuotaInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetQuotaUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetQuotaUsageResponse implements ResponseInterface
{
    /**
     * 1 (true) if there are more accounts left to return
     * @Accessor(getter="isMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of accounts that matched search (not affected by limit/offset)
     * @Accessor(getter="getSearchTotal", setter="setSearchTotal")
     * @SerializedName("searchTotal")
     * @Type("integer")
     * @XmlAttribute
     */
    private $searchTotal;

    /**
     * Account quota information
     * @Accessor(getter="getAccountQuotas", setter="setAccountQuotas")
     * @SerializedName("account")
     * @Type("array<Zimbra\Admin\Struct\AccountQuotaInfo>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accountQuotas;

    /**
     * Constructor method for GetQuotaUsageResponse
     * 
     * @param bool $more
     * @param int $searchTotal
     * @param array $accountQuotas
     * @return self
     */
    public function __construct(
    	bool $more,
        int $searchTotal,
        array $accountQuotas = [])
    {
        $this->setMore($more)
        	 ->setSearchTotal($searchTotal)
        	 ->setAccountQuotas($accountQuotas);
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function isMore(): bool
    {
        return $this->more;
    }

    /**
     * Sets more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Gets searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Sets searchTotal
     *
     * @param  int $searchTotal
     * @return self
     */
    public function setSearchTotal(int $searchTotal): self
    {
        $this->searchTotal = $searchTotal;
        return $this;
    }

    /**
     * Add account quota information
     *
     * @param  AccountQuotaInfo $quota
     * @return self
     */
    public function addAccountQuota(AccountQuotaInfo $quota): self
    {
        $this->accountQuotas[] = $quota;
        return $this;
    }

    /**
     * Sets account quota information
     *
     * @param array $accountQuotas
     * @return self
     */
    public function setAccountQuotas(array $accountQuotas): self
    {
        $this->accountQuotas = [];
        foreach ($accountQuotas as $quota) {
            if ($quota instanceof AccountQuotaInfo) {
                $this->accountQuotas[] = $quota;
            }
        }
        return $this;
    }

    /**
     * Gets account quota information
     *
     * @return array
     */
    public function getAccountQuotas(): array
    {
        return $this->accountQuotas;
    }
}
