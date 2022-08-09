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
use Zimbra\Admin\Struct\SimpleSessionInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetSessionsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSessionsResponse extends SoapResponse
{
    /**
     * 1 (true) if more sessions left to return
     * 
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of accounts that matched search (not affected by limit/offset)
     * 
     * @Accessor(getter="getTotal", setter="setTotal")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $total;

    /**
     * Session information
     * 
     * @Accessor(getter="getSessions", setter="setSessions")
     * @Type("array<Zimbra\Admin\Struct\SimpleSessionInfo>")
     * @XmlList(inline=true, entry="s", namespace="urn:zimbraAdmin")
     */
    private $sessions = [];

    /**
     * Constructor
     * 
     * @param bool $more
     * @param int $total
     * @param array $sessions
     * @return self
     */
    public function __construct(
        bool $more = FALSE,
        int $total = 0,
        array $sessions = []
    )
    {
        $this->setMore($more)
             ->setTotal($total)
             ->setSessions($sessions);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
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
     * Get total
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Set total
     *
     * @param  int $total
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Set session information
     *
     * @param array $sessions
     * @return self
     */
    public function setSessions(array $sessions): self
    {
        $this->sessions = array_filter($sessions, static fn ($session) => $session instanceof SimpleSessionInfo);
        return $this;
    }

    /**
     * Get session information
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }
}
