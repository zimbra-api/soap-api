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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * ModifyContactSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyContactSpec
{
    /**
     * ID - specified when modifying a contact
     * 
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('int')]
    #[XmlAttribute]
    private $id;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName('tn')]
    #[Type('string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Contact attributes.  Cannot specify <vcard> as well as these
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrs', setter: 'setAttrs')]
    #[Type('array<Zimbra\Mail\Struct\ModifyContactAttr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraMail')]
    private $attrs = [];

    /**
     * Valid only if the contact being created is a contact group
     * (has attribute type="group")
     * 
     * @var array
     */
    #[Accessor(getter: 'getContactGroupMembers', setter: 'setContactGroupMembers')]
    #[Type('array<Zimbra\Mail\Struct\ModifyContactGroupMember>')]
    #[XmlList(inline: true, entry: 'm', namespace: 'urn:zimbraMail')]
    private $contactGroupMembers = [];

    /**
     * Constructor
     *
     * @param int $id
     * @param string $tagNames
     * @param array $attrs
     * @param array $contactGroupMembers
     * @return self
     */
    public function __construct(
        ?int $id = NULL,
        ?string $tagNames = NULL,
        array $attrs = [],
        array $contactGroupMembers = []
    )
    {
        $this->setAttrs($attrs)
             ->setContactGroupMembers($contactGroupMembers);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
    }

    /**
     * Get Contact Id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set Contact Id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get tag names
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tag names
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof ModifyContactAttr);
        return $this;
    }

    /**
     * Add an contact attribute
     *
     * @param  ModifyContactAttr $attr
     * @return self
     */
    public function addAttr(ModifyContactAttr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Get contact group members
     *
     * @return array
     */
    public function getContactGroupMembers(): array
    {
        return $this->contactGroupMembers;
    }

    /**
     * Set contact group members
     *
     * @param  array $members
     * @return self
     */
    public function setContactGroupMembers(array $members): self
    {
        $this->contactGroupMembers = array_filter($members, static fn ($member) => $member instanceof ModifyContactGroupMember);
        return $this;
    }

    /**
     * Add contact group member
     *
     * @param  ModifyContactGroupMember $contactGroupMember
     * @return self
     */
    public function addContactGroupMember(ModifyContactGroupMember $contactGroupMember): self
    {
        $this->contactGroupMembers[] = $contactGroupMember;
        return $this;
    }
}
