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
use Zimbra\Admin\Struct\Stat;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetServerStats request class
 * Returns server monitoring stats.
 * These are the same stats that are logged to mailboxd.csv.
 * If no stat element is specified, all server stats are returned.
 * If the stat name is invalid, returns a SOAP fault.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetServerStatsRequest extends Request
{
    /**
     * Stats
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stat")
     * @Type("array<Zimbra\Admin\Struct\Stat>")
     * @XmlList(inline = true, entry = "stat")
     */
    private $stats = [];

    /**
     * Constructor method for GetServerStatsRequest
     * 
     * @param array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        $this->setStats($stats);
    }

    /**
     * Add a stat
     *
     * @param  Stat $stat
     * @return self
     */
    public function addStat(Stat $stat): self
    {
        $this->stats[] = $stat;
        return $this;
    }

    /**
     * Sets stats
     *
     * @param array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = array_filter($stats, static fn ($stat) => $stat instanceof Stat);
        return $this;
    }

    /**
     * Gets stats
     *
     * @return array
     */
    public function getStats(): ?array
    {
        return $this->stats;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetServerStatsEnvelope(
            new GetServerStatsBody($this)
        );
    }
}
