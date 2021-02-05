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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AccountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="account")
 */
class AccountInfo extends AdminObjectInfo
{
    /**
     * Is external
     * @Accessor(getter="getIsExternal", setter="setIsExternal")
     * @SerializedName("isExternal")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isExternal;

    /**
     * Constructor method for AccountInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  bool $isExternal
     * @param  array  $attrs
     * @return self
     */
    public function __construct(string $name, string $id, ?bool $isExternal = NULL, array $attrs = [])
    {
        parent::__construct($name, $id, $attrs);
        if (NULL !== $isExternal) {
            $this->setIsExternal($isExternal);
        }
    }

    /**
     * Gets is external
     *
     * @return bool
     */
    public function getIsExternal(): ?bool
    {
        return $this->isExternal;
    }

    /**
     * Sets is external
     *
     * @param  bool $isExternal
     * @return self
     */
    public function setIsExternal(bool $isExternal): self
    {
        $this->isExternal = $isExternal;
        return $this;
    }
}