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
use Zimbra\Common\Struct\SoapResponse;

/**
 * QueryWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueryWaitSetResponse extends SoapResponse
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
     * Constructor
     *
     * @param array $waitsets
     * @return self
     */
    public function __construct(array $waitsets = [])
    {
        $this->setWaitsets($waitsets);
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
