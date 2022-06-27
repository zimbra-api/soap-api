<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\CheckRightsTargetInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckRightsResponse implements ResponseInterface
{
    /**
     * Rights information for targets
     * @Accessor(getter="getTargets", setter="setTargets")
     * @SerializedName("target")
     * @Type("array<Zimbra\Account\Struct\CheckRightsTargetInfo>")
     * @XmlList(inline=true, entry="target", namespace="urn:zimbraAccount")
     */
    private $targets = [];

    /**
     * Constructor method for CheckRightsResponse
     * 
     * @param  array $targets
     * @return self
     */
    public function __construct(array $targets = [])
    {
        $this->setTargets($targets);
    }

    /**
     * Add a target
     *
     * @param  CheckRightsTargetInfo $target
     * @return self
     */
    public function addTarget(CheckRightsTargetInfo $target): self
    {
        $this->targets[] = $target;
        return $this;
    }

    /**
     * Set targets
     *
     * @param  array $targets
     * @return self
     */
    public function setTargets(array $targets): self
    {
        $this->targets = array_filter($targets, static fn ($target) => $target instanceof CheckRightsTargetInfo);
        return $this;
    }

    /**
     * Gets targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
