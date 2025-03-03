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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Common\Enum\TargetType;

/**
 * DiscoverRightsTarget struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsTarget
{
    /**
     * Target type
     *
     * @var TargetType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private TargetType $type;

    /**
     * Target ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * Target name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * If a discovered target is an account or a group and the entry has a display name set then this is set to that display name.
     *
     * @var string
     */
    #[Accessor(getter: "getDisplayName", setter: "setDisplayName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $displayName = null;

    /**
     * Email addresses
     *
     * @var array
     */
    #[Accessor(getter: "getEmails", setter: "setEmails")]
    #[Type("array<Zimbra\Account\Struct\DiscoverRightsEmail>")]
    #[XmlList(inline: true, entry: "email", namespace: "urn:zimbraAccount")]
    private array $emails = [];

    /**
     * Constructor
     *
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  string $displayName
     * @param  array $emails
     * @return self
     */
    public function __construct(
        ?TargetType $type = null,
        ?string $id = null,
        ?string $name = null,
        ?string $displayName = null,
        array $emails = []
    ) {
        $this->setType($type ?? TargetType::ACCOUNT)->setEmails($emails);
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
    }

    /**
     * Get target type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Set target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setType(TargetType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set displayName
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
     * Set emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = array_filter(
            $emails,
            static fn($email) => $email instanceof DiscoverRightsEmail
        );
        return $this;
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }
}
