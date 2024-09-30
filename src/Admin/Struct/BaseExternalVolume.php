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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * BaseExternalVolume struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class BaseExternalVolume
{
    /**
     * Set to 1 for Internal and 2 for External.
     *
     * @var string
     */
    #[Accessor(getter: "getStorageType", setter: "setStorageType")]
    #[SerializedName("storageType")]
    #[Type("string")]
    #[XmlAttribute]
    private $storageType;

    /**
     * Constructor
     *
     * @param  string $storageType
     * @return self
     */
    public function __construct(?string $storageType = null)
    {
        if (null !== $storageType) {
            $this->setStorageType($storageType);
        }
    }

    /**
     * Get storageType
     *
     * @return string
     */
    public function getStorageType(): ?string
    {
        return $this->storageType;
    }

    /**
     * Set storageType
     *
     * @param  string $storageType
     * @return self
     */
    public function setStorageType(string $storageType): self
    {
        $this->storageType = $storageType;
        return $this;
    }
}
