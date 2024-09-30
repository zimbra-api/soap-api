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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * ComboRights struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ComboRights
{
    /**
     * Rights information
     *
     * @var array
     */
    #[Accessor(getter: "getComboRights", setter: "setComboRights")]
    #[Type("array<Zimbra\Admin\Struct\ComboRightInfo>")]
    #[XmlList(inline: true, entry: "r", namespace: "urn:zimbraAdmin")]
    private $comboRights = [];

    /**
     * Constructor
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
     * Set rights
     *
     * @param array $comboRights
     * @return self
     */
    public function setComboRights(array $comboRights): self
    {
        $this->comboRights = array_filter(
            $comboRights,
            static fn($right) => $right instanceof ComboRightInfo
        );
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getComboRights(): array
    {
        return $this->comboRights;
    }
}
