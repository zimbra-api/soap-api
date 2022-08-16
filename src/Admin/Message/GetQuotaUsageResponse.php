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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetQuotaUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetQuotaUsageResponse extends SoapResponse
{
    /**
     * 1 (true) if there are more accounts left to return
     * 
     * @var bool
     */
    #[Accessor(getter: 'isMore', setter: 'setMore')]
    #[SerializedName(name: 'more')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $more;

    /**
     * Total number of accounts that matched search (not affected by limit/offset)
     * 
     * @var int
     */
    #[Accessor(getter: 'getSearchTotal', setter: 'setSearchTotal')]
    #[SerializedName(name: 'searchTotal')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $searchTotal;

    /**
     * Account quota information
     * 
     * @var array
     */
    #[Accessor(getter: 'getAccountQuotas', setter: 'setAccountQuotas')]
    #[Type(name: 'array<Zimbra\Admin\Struct\AccountQuotaInfo>')]
    #[XmlList(inline: true, entry: 'account', namespace: 'urn:zimbraAdmin')]
    private $accountQuotas = [];

    /**
     * Constructor
     * 
     * @param bool $more
     * @param int $searchTotal
     * @param array $accountQuotas
     * @return self
     */
    public function __construct(
    	bool $more = FALSE,
        int $searchTotal = 0,
        array $accountQuotas = [])
    {
        $this->setMore($more)
        	 ->setSearchTotal($searchTotal)
        	 ->setAccountQuotas($accountQuotas);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function isMore(): bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Get searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Set searchTotal
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
     * Set account quota information
     *
     * @param array $quotas
     * @return self
     */
    public function setAccountQuotas(array $quotas): self
    {
        $this->accountQuotas = array_filter($quotas, static fn ($quota) => $quota instanceof AccountQuotaInfo);
        return $this;
    }

    /**
     * Get account quota information
     *
     * @return array
     */
    public function getAccountQuotas(): array
    {
        return $this->accountQuotas;
    }
}
