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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};

/**
 * ComboRights struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ComboRights
{
    /**
     * Rights information
     * @Accessor(getter="getComboRights", setter="setComboRights")
     * @SerializedName("r")
     * @Type("array<Zimbra\Admin\Struct\ComboRightInfo>")
     * @XmlList(inline = true, entry = "r")
     */
    private $comboRights = [];

    /**
     * Constructor method for ComboRights
     * 
     * @param  array  $comboRights
     * @return self
     */
    public function __construct(array $comboRights = [])
    {
        $this->setComboRights($comboRights);
    }

    /**
     * Add combo right
     *
     * @param  ComboRightInfo $right
     * @return self
     */
    public function addComboRight(ComboRightInfo $right): self
    {
        $this->comboRights[] = $right;
        return $this;
    }

    /**
     * Sets rights
     *
     * @param array $comboRights
     * @return self
     */
    public function setComboRights(array $comboRights): self
    {
        $this->comboRights = [];
        foreach ($comboRights as $right) {
            if ($right instanceof ComboRightInfo) {
                $this->comboRights[] = $right;
            }
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getComboRights(): array
    {
        return $this->comboRights;
    }
}
