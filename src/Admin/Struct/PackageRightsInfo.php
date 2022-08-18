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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * PackageRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copycmd © 2020-present by Nguyen Van Nguyen.
 */
class PackageRightsInfo
{
    /**
     * Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Command cmds information
     * 
     * @var array
     */
    #[Accessor(getter: 'getCmds', setter: 'setCmds')]
    #[Type('array<Zimbra\Admin\Struct\CmdRightsInfo>')]
    #[XmlList(inline: true, entry: 'cmd', namespace: 'urn:zimbraAdmin')]
    private $cmds = [];

    /**
     * Constructor
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
     * Get cmds
     *
     * @return array
     */
    public function getCmds()
    {
        return $this->cmds;
    }

    /**
     * Set cmds
     *
     * @param  array $cmds
     * @return self
     */
    public function setCmds(array $cmds)
    {
        $this->cmds = array_filter($cmds, static fn ($cmd) => $cmd instanceof CmdRightsInfo);
        return $this;
    }
}
