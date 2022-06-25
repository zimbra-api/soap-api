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
use Zimbra\Admin\Struct\WaitSetInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * QueryWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class QueryWaitSetResponse implements ResponseInterface
{
    /**
     * Information about WaitSets
     * 
     * @Accessor(getter="getWaitsets", setter="setWaitsets")
     * @SerializedName("waitSet")
     * @Type("array<Zimbra\Admin\Struct\WaitSetInfo>")
     * @XmlList(inline=true, entry="waitSet")
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
     * Sets waitsets
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
     * Gets waitsets
     *
     * @return array
     */
    public function getWaitsets(): array
    {
        return $this->waitsets;
    }
}
