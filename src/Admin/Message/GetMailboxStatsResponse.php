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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\MailboxStats;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMailboxStatsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailboxStatsResponse extends SoapResponse
{
    /**
     * Statistics about mailboxes
     * 
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\MailboxStats")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var MailboxStats
     */
    private $stats;

    /**
     * Constructor
     *
     * @param MailboxStats $stats
     * @return self
     */
    public function __construct(?MailboxStats $stats = NULL)
    {
        if ($stats instanceof MailboxStats) {
            $this->setStats($stats);
        }
    }

    /**
     * Get the mailbox
     *
     * @return MailboxStats
     */
    public function getStats(): ?MailboxStats
    {
        return $this->stats;
    }

    /**
     * Set mailbox
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
