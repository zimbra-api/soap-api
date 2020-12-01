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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};

/**
 * ReplaceheaderAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="actionReplaceheader")
 */
class ReplaceheaderAction extends DeleteheaderAction
{
    /**
     * inewName
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $newName;

    /**
     * newValue
     * @Accessor(getter="getNewValue", setter="setNewValue")
     * @SerializedName("newValue")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $newValue;

    /**
     * Constructor method for ReplaceheaderAction
     * 
     * @param int $index
     * @param bool $last
     * @param int $offset
     * @param EditheaderTest $test
     * @param string $newName
     * @param newValue $newValue
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $last = NULL,
        ?int $offset = NULL,
        ?EditheaderTest $test = NULL,
        ?string $newName = NULL,
        ?string $newValue = NULL
    )
    {
    	parent::__construct($index, $last, $offset, $test);
        if (NULL !== $newName) {
            $this->setNewName($newName);
        }
        if (NULL !== $newValue) {
            $this->setNewValue($newValue);
        }
    }

    /**
     * Gets newName
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Sets newName
     *
     * @param  bool $newName
     * @return self
     */
    public function setNewName(string $newName)
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Gets newValue
     *
     * @return string
     */
    public function getNewValue(): ?string
    {
        return $this->newValue;
    }

    /**
     * Sets newValue
     *
     * @param  string $newValue
     * @return self
     */
    public function setNewValue(string $newValue)
    {
        $this->newValue = $newValue;
        return $this;
    }
}
