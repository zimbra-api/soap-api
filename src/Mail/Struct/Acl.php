<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * Acl class
 * Access control level
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Acl
{
    /**
     * Time when grants to internal grantees expire.
     * @Accessor(getter="getInternalGrantExpiry", setter="setInternalGrantExpiry")
     * @SerializedName("internalGrantExpiry")
     * @Type("integer")
     * @XmlAttribute
     */
    private $internalGrantExpiry;

    /**
     * Time when grants to guest grantees expire.
     * @Accessor(getter="getGuestGrantExpiry", setter="setGuestGrantExpiry")
     * @SerializedName("guestGrantExpiry")
     * @Type("integer")
     * @XmlAttribute
     */
    private $guestGrantExpiry;

    /**
     * Grants
     * @Accessor(getter="getGrants", setter="setGrants")
     * @SerializedName("grant")
     * @Type("array<Zimbra\Mail\Struct\Grant>")
     * @XmlList(inline = true, entry = "grant")
     */
    private $grants = [];

    /**
     * Constructor method for Acl
     *
     * @param  int $internalGrantExpiry
     * @param  int $guestGrantExpiry
     * @param  array $grants
     * @return self
     */
    public function __construct(
        ?int $internalGrantExpiry = NULL,
        ?int $guestGrantExpiry = NULL,
        array $grants = []
    )
    {
        $this->setGrants($grants);
        if (NULL !== $internalGrantExpiry) {
            $this->setInternalGrantExpiry($internalGrantExpiry);
        }
        if (NULL !== $guestGrantExpiry) {
            $this->setGuestGrantExpiry($guestGrantExpiry);
        }
    }

    /**
     * Gets internalGrantExpiry
     *
     * @return int
     */
    public function getInternalGrantExpiry(): ?int
    {
        return $this->internalGrantExpiry;
    }

    /**
     * Sets internalGrantExpiry
     *
     * @param  int $internalGrantExpiry
     * @return self
     */
    public function setInternalGrantExpiry(int $internalGrantExpiry): self
    {
        $this->internalGrantExpiry = $internalGrantExpiry;
        return $this;
    }

    /**
     * Gets guestGrantExpiry
     *
     * @return int
     */
    public function getGuestGrantExpiry(): ?int
    {
        return $this->guestGrantExpiry;
    }

    /**
     * Sets guestGrantExpiry
     *
     * @param  int $guestGrantExpiry
     * @return self
     */
    public function setGuestGrantExpiry(int $guestGrantExpiry): self
    {
        $this->guestGrantExpiry = $guestGrantExpiry;
        return $this;
    }

    /**
     * Sets grants
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter($grants, static fn($grant) => $grant instanceof Grant);
        return $this;
    }

    /**
     * Gets grants
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Add grant
     *
     * @param  Grant $grant
     * @return self
     */
    public function addGrant(Grant $grant): self
    {
        $this->grants[] = $grant;
        return $this;
    }
}
