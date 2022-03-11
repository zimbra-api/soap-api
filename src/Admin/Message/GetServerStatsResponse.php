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
use Zimbra\Soap\ResponseInterface;

/**
 * GetServerStatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetServerStatsResponse implements ResponseInterface
{
    /**
     * Details of server monitoring statistics
     * 
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stat")
     * @Type("array<Zimbra\Admin\Struct\Stat>")
     * @XmlList(inline = true, entry = "stat")
     */
    private $stats;

    /**
     * Constructor method for GetServerStatsResponse
     *
     * @param array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        $this->setStats($stats);
    }

    /**
     * Add stat
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
     * Sets statistics
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = [];
        foreach ($stats as $stat) {
            if ($stat instanceof Stat) {
                $this->stats[] = $stat;
            }
        }
        return $this;
    }

    /**
     * Gets statistics
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}
