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
use Zimbra\Admin\Struct\Stat;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetServerStatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetServerStatsResponse extends SoapResponse
{
    /**
     * Details of server monitoring statistics
     * 
     * @Accessor(getter="getStats", setter="setStats")
     * @Type("array<Zimbra\Admin\Struct\Stat>")
     * @XmlList(inline=true, entry="stat", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getStats', setter: 'setStats')]
    #[Type(name: 'array<Zimbra\Admin\Struct\Stat>')]
    #[XmlList(inline: true, entry: 'stat', namespace: 'urn:zimbraAdmin')]
    private $stats = [];

    /**
     * Constructor
     *
     * @param array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        $this->setStats($stats);
    }

    /**
     * Set statistics
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = array_filter($stats, static fn ($stat) => $stat instanceof Stat);
        return $this;
    }

    /**
     * Get statistics
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}
