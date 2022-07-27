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
use Zimbra\Admin\Struct\MailboxInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAllMailboxesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllMailboxesResponse implements SoapResponseInterface
{
    /**
     * Mailboxes
     * 
     * @Accessor(getter="getMboxes", setter="setMboxes")
     * @Type("array<Zimbra\Admin\Struct\MailboxInfo>")
     * @XmlList(inline=true, entry="mbox", namespace="urn:zimbraAdmin")
     */
    private $mboxes = [];

    /**
     * 1 (true) if more mailboxes left to return
     * @Accessor(getter="isMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of mailboxes that matched search (not affected by more/offset)
     * @Accessor(getter="getSearchTotal", setter="setSearchTotal")
     * @SerializedName("searchTotal")
     * @Type("integer")
     * @XmlAttribute
     */
    private $searchTotal;

    /**
     * Constructor method for GetAllMailboxesResponse
     *
     * @param bool $more
     * @param integer $searchTotal
     * @param array $mboxes
     * @return self
     */
    public function __construct(bool $more = FALSE, int $searchTotal = 0, array $mboxes = [])
    {
        $this->setMore($more)
             ->setSearchTotal($searchTotal)
             ->setMboxes($mboxes);
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
     * Add a mbox information
     *
     * @param  MailboxInfo $mbox
     * @return self
     */
    public function addMbox(MailboxInfo $mbox): self
    {
        $this->mboxes[] = $mbox;
        return $this;
    }

    /**
     * Sets mbox informations
     *
     * @param  array $mboxes
     * @return self
     */
    public function setMboxes(array $mboxes): self
    {
        $this->mboxes = array_filter($mboxes, static fn ($mbox) => $mbox instanceof MailboxInfo);
        return $this;
    }

    /**
     * Gets mbox informations
     *
     * @return array
     */
    public function getMboxes(): array
    {
        return $this->mboxes;
    }
}
