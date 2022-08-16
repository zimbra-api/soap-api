<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\NamedElement;

/**
 * StatsValueWrapper struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class StatsValueWrapper
{
    /**
     * Stats specification
     * 
     * @var array
     */
    #[Accessor(getter: 'getStats', setter: 'setStats')]
    #[Type(name: 'array<Zimbra\Common\Struct\NamedElement>')]
    #[XmlList(inline: true, entry: 'stat', namespace: 'urn:zimbraAdmin')]
    private $stats = [];

    /**
     * Constructor
     * 
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        $this->setStats($stats);
    }

    /**
     * Add a stat
     *
     * @param  NamedElement $stat
     * @return self
     */
    public function addStat(NamedElement $stat): self
    {
        $this->stats[] = $stat;
        return $this;
    }

    /**
     * Set stats
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = array_filter($stats, static fn ($stat) => $stat instanceof NamedElement);
        return $this;
    }

    /**
     * Get stats
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}
