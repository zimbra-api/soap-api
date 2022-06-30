<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};

/**
 * RetentionPolicy struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RetentionPolicy
{
    /**
     * "Keep" retention policies
     * @Accessor(getter="getKeepPolicy", setter="setKeepPolicy")
     * @SerializedName("keep")
     * @Type("array<Zimbra\Mail\Struct\Policy>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="policy", namespace="urn:zimbraMail")
     */
    private $keep = [];

    /**
     * "Purge" retention policies
     * @Accessor(getter="getPurgePolicy", setter="setPurgePolicy")
     * @SerializedName("purge")
     * @Type("array<Zimbra\Mail\Struct\Policy>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="policy", namespace="urn:zimbraMail")
     */
    private $purge = [];

    /**
     * Constructor method for RetentionPolicy
     *
     * @param  array $keep
     * @param  array $purge
     * @return self
     */
    public function __construct(array $keep = [], array $purge = [])
    {
        $this->setKeepPolicy($keep)
             ->setPurgePolicy($purge);
    }

    /**
     * Gets keep policies.
     *
     * @return Policy
     */
    public function getKeepPolicy(): array
    {
        return $this->keep;
    }

    /**
     * Sets keep policies.
     *
     * @param  array $policies
     * @return self
     */
    public function setKeepPolicy(array $policies): self
    {
        $this->keep = array_filter($policies, static fn ($policy) => $policy instanceof Policy);
        return $this;
    }

    /**
     * Gets purge policies.
     *
     * @return Policy
     */
    public function getPurgePolicy(): array
    {
        return $this->purge;
    }

    /**
     * Sets purge policies.
     *
     * @param  array $policies
     * @return self
     */
    public function setPurgePolicy(array $policies): self
    {
        $this->purge = array_filter($policies, static fn ($policy) => $policy instanceof Policy);
        return $this;
    }
}
