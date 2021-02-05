<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copycmd and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * PackageRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copycmd © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="package")
 */
class PackageRightsInfo
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
     * Command cmds information
     * @Accessor(getter="getCmds", setter="setCmds")
     * @SerializedName("cmd")
     * @Type("array<Zimbra\Admin\Struct\CmdRightsInfo>")
     * @XmlList(inline = true, entry = "cmd")
     */
    private $cmds;

    /**
     * Constructor method for PackageRightsInfo
     *
     * @param string $name
     * @param array  $cmds
     * @return self
     */
    public function __construct(?string $name = NULL, array $cmds = [])
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        $this->setCmds($cmds);
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
     * Gets cmds
     *
     * @return array
     */
    public function getCmds()
    {
        return $this->cmds;
    }

    /**
     * Sets cmds
     *
     * @param  array $cmds
     * @return self
     */
    public function setCmds(array $cmds)
    {
        $this->cmds = [];
        foreach ($cmds as $cmd) {
            if ($cmd instanceof CmdRightsInfo) {
                $this->cmds[] = $cmd;
            }
        }
        return $this;
    }

    /**
     * Add cmd
     *
     * @param  CmdRightsInfo $cmd
     * @return self
     */
    public function addCmd(CmdRightsInfo $cmd)
    {
        $this->cmds[] = $cmd;
        return $this;
    }
}