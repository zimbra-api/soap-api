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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\NamedElement;

/**
 * CmdRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CmdRightsInfo
{
    /**
     * Name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Rights
     *
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="right", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("rights")]
    #[Type("array<Zimbra\Common\Struct\NamedElement>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "right", namespace: "urn:zimbraAdmin")]
    private $rights = [];

    /**
     * Notes
     *
     * @Accessor(getter="getNotes", setter="setNotes")
     * @SerializedName("desc")
     * @Type("array<string>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="note", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getNotes", setter: "setNotes")]
    #[SerializedName("desc")]
    #[Type("array<string>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "note", namespace: "urn:zimbraAdmin")]
    private $notes = [];

    /**
     * Constructor
     *
     * @param string $name
     * @param array  $rights
     * @param array  $notes
     * @return self
     */
    public function __construct(
        ?string $name = null,
        array $rights = [],
        array $notes = []
    ) {
        $this->setRights($rights)->setNotes($notes);
        if (null !== $name) {
            $this->setName($name);
        }
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
     * Get notes
     *
     * @return array
     */
    public function getNotes(): array
    {
        return $this->notes;
    }

    /**
     * Set notes
     *
     * @param  array $notes
     * @return self
     */
    public function setNotes(array $notes): self
    {
        $this->notes = array_unique(
            array_map(static fn($note) => trim($note), $notes)
        );
        return $this;
    }

    /**
     * add note
     *
     * @param  string $note
     * @return self
     */
    public function addNote(string $note): self
    {
        $this->notes[] = trim($note);
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter(
            $rights,
            static fn($right) => $right instanceof NamedElement
        );
        return $this;
    }

    /**
     * Add right
     *
     * @param  NamedElement $right
     * @return self
     */
    public function addRight(NamedElement $right): self
    {
        $this->rights[] = $right;
        return $this;
    }
}
