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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};

/**
 * RetentionPolicy struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RetentionPolicy
{
    /**
     * "Keep" retention policies
     *
     * @var array
     */
    #[Accessor(getter: "getKeepPolicy", setter: "setKeepPolicy")]
    #[SerializedName("keep")]
    #[Type("array<Zimbra\Mail\Struct\Policy>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "policy", namespace: "urn:zimbraMail")]
    private array $keep = [];

    /**
     * "Purge" retention policies
     *
     * @var array
     */
    #[Accessor(getter: "getPurgePolicy", setter: "setPurgePolicy")]
    #[SerializedName("purge")]
    #[Type("array<Zimbra\Mail\Struct\Policy>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "policy", namespace: "urn:zimbraMail")]
    private array $purge = [];

    /**
     * Constructor
     *
     * @param  array $keep
     * @param  array $purge
     * @return self
     */
    public function __construct(array $keep = [], array $purge = [])
    {
        $this->setKeepPolicy($keep)->setPurgePolicy($purge);
    }

    /**
     * Get keep policies.
     *
     * @return array
     */
    public function getKeepPolicy(): array
    {
        return $this->keep;
    }

    /**
     * Set keep policies.
     *
     * @param  array $policies
     * @return self
     */
    public function setKeepPolicy(array $policies): self
    {
        $this->keep = array_filter(
            $policies,
            static fn($policy) => $policy instanceof Policy
        );
        return $this;
    }

    /**
     * Get purge policies.
     *
     * @return array
     */
    public function getPurgePolicy(): array
    {
        return $this->purge;
    }

    /**
     * Set purge policies.
     *
     * @param  array $policies
     * @return self
     */
    public function setPurgePolicy(array $policies): self
    {
        $this->purge = array_filter(
            $policies,
            static fn($policy) => $policy instanceof Policy
        );
        return $this;
    }
}
