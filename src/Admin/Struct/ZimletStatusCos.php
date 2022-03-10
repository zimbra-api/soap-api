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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * ZimletStatusCos struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ZimletStatusCos
{
    /**
     * Class Of Service (COS) name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Information on zimlet status
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlet")
     * @Type("array<Zimbra\Admin\Struct\ZimletStatus>")
     * @XmlList(inline = true, entry = "zimlet")
     */
    private $zimlets = [];

    /**
     * Constructor method for ZimletStatusCos
     *
     * @param  string $name
     * @param  array $zimlets
     * @return self
     */
    public function __construct(string $name, array $zimlets = [])
    {
        $this->setName($name)
             ->setZimlets($zimlets);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
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
     * Add a zimlet
     *
     * @param  ZimletStatus $zimlet
     * @return self
     */
    public function addZimlet(ZimletStatus $zimlet): self
    {
        $this->zimlets[] = $zimlet;
        return $this;
    }

    /**
     * Sets zimlets
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = [];
        foreach ($zimlets as $zimlet) {
            if ($zimlet instanceof ZimletStatus) {
                $this->zimlets[] = $zimlet;
            }
        }
        return $this;
    }

    /**
     * Gets zimlets
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }
}
