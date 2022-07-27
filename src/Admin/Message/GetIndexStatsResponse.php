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
use Zimbra\Admin\Struct\IndexStats;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetIndexStatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetIndexStatsResponse implements SoapResponseInterface
{
    /**
     * Statistics about mailboxes
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\IndexStats")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?IndexStats $stats = NULL;

    /**
     * Constructor method for GetIndexStatsResponse
     *
     * @param Account $stats
     * @return self
     */
    public function __construct(?IndexStats $stats = NULL)
    {
        if ($stats instanceof IndexStats) {
            $this->setStats($stats);
        }
    }

    /**
     * Gets the stats.
     *
     * @return IndexStats
     */
    public function getStats(): ?IndexStats
    {
        return $this->stats;
    }

    /**
     * Sets the stats.
     *
     * @param  IndexStats $stats
     * @return self
     */
    public function setStats(IndexStats $stats): self
    {
        $this->stats = $stats;
        return $this;
    }
}
