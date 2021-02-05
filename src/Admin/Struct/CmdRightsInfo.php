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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Struct\NamedElement;

/**
 * CmdRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="cmd")
 */
class CmdRightsInfo
{
    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = false, entry = "right")
     */
    private $rights;

    /**
     * Notes
     * @Accessor(getter="getNotes", setter="setNotes")
     * @SerializedName("desc")
     * @Type("array<string>")
     * @XmlList(inline = false, entry = "note")
     */
    private $notes;

    /**
     * Constructor method for CmdRightsInfo
     *
     * @param string $name
     * @param array  $rights
     * @param array  $notes
     * @return self
     */
    public function __construct(?string $name = NULL, array $rights = [], array $notes = [])
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        $this->setRights($rights)
             ->setNotes($notes);
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
     * Gets notes
     *
     * @return array
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Sets notes
     *
     * @param  array $notes
     * @return self
     */
    public function setNotes(array $notes)
    {
        $this->notes = [];
        foreach ($notes as $note) {
            $this->notes[] = $note;
        }
        return $this;
    }

    /**
     * add note
     *
     * @param  string $note
     * @return self
     */
    public function addNote($note)
    {
        $this->notes[] = $note;
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->rights = [];
        foreach ($rights as $right) {
            if ($right instanceof NamedElement) {
                $this->rights[] = $right;
            }
        }
        return $this;
    }

    /**
     * Add right
     *
     * @param  NamedElement $right
     * @return self
     */
    public function addRight(NamedElement $right)
    {
        $this->rights[] = $right;
        return $this;
    }
}