<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\TargetType;

/**
 * DiscoverRightsTarget struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DiscoverRightsTarget
{
    /**
     * Target type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\TargetType")
     * @XmlAttribute
     */
    private TargetType $type;

    /**
     * Target ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Target name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * If a discovered target is an account or a group and the entry has a display name set then this is set to that display name.
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * Email addresses
     * @Accessor(getter="getEmails", setter="setEmails")
     * @SerializedName("email")
     * @Type("array<Zimbra\Account\Struct\DiscoverRightsEmail>")
     * @XmlList(inline = true, entry = "email")
     */
    private $emails = [];

    /**
     * Constructor method for DiscoverRightsTarget
     *
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  string $displayName
     * @param  array $emails
     * @return self
     */
    public function __construct(
        TargetType $type,
        ?string $id = NULL,
        ?string $name = NULL,
        ?string $displayName = NULL,
        array $emails = []
    )
    {
        $this->setType($type)
            ->setEmails($emails);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
    }

    /**
     * Gets target type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->targetType;
    }

    /**
     * Sets target type
     *
     * @param  string $type
     * @return self
     */
    public function setType(TargetType $type): self
    {
        $this->targetType = $type;
        return $this;
    }

    /**
     * Gets id
     *
     * @return TargetBy
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Sets displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Add an addEmail
     *
     * @param  DiscoverRightsEmail $email
     * @return self
     */
    public function addEmail(DiscoverRightsEmail $email): self
    {
        $this->emails[] = $email;
        return $this;
    }

    /**
     * Sets emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = [];
        foreach ($emails as $email) {
            if ($email instanceof DiscoverRightsEmail) {
                $this->emails[] = $email;
            }
        }
        return $this;
    }

    /**
     * Gets emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }
}
