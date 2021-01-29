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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\MailboxStats;
use Zimbra\Soap\ResponseInterface;

/**
 * GetMailboxStatsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetMailboxStatsResponse")
 */
class GetMailboxStatsResponse implements ResponseInterface
{
    /**
     * Statistics about mailboxes
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\MailboxStats")
     * @XmlElement
     */
    private $stats;

    /**
     * Constructor method for GetMailboxStatsResponse
     *
     * @param MailboxStats $stats
     * @return self
     */
    public function __construct(MailboxStats $stats)
    {
        $this->setStats($stats);
    }

    /**
     * Gets the mailbox
     *
     * @return MailboxStats
     */
    public function getStats(): MailboxStats
    {
        return $this->stats;
    }

    /**
     * Sets mailbox
     *
     * @param  MailboxStats $stats
     * @return self
     */
    public function setStats(MailboxStats $stats): self
    {
        $this->stats = $stats;
        return $this;
    }
}
