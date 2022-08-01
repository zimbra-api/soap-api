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
use Zimbra\Admin\Struct\WaitSetInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * QueryWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueryWaitSetResponse implements SoapResponseInterface
{
    /**
     * Information about WaitSets
     * 
     * @Accessor(getter="getWaitsets", setter="setWaitsets")
     * @Type("array<Zimbra\Admin\Struct\WaitSetInfo>")
     * @XmlList(inline=true, entry="waitSet", namespace="urn:zimbraAdmin")
     */
    private $waitsets = [];

    /**
     * Constructor method for QueryWaitSetResponse
     *
     * @param array $waitsets
     * @return self
     */
    public function __construct(array $waitsets = [])
    {
        $this->setWaitsets($waitsets);
    }

    /**
     * Add waitset
     *
     * @param  WaitSetInfo $waitset
     * @return self
     */
    public function addWaitset(WaitSetInfo $waitset): self
    {
        $this->waitsets[] = $waitset;
        return $this;
    }

    /**
     * Set waitsets
     *
     * @param  array $waitsets
     * @return self
     */
    public function setWaitsets(array $waitsets): self
    {
        $this->waitsets = array_filter($waitsets, static fn ($waitset) => $waitset instanceof WaitSetInfo);
        return $this;
    }

    /**
     * Get waitsets
     *
     * @return array
     */
    public function getWaitsets(): array
    {
        return $this->waitsets;
    }
}
