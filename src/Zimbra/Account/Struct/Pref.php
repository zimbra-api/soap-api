<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * Preference struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="pref")
 */
class Pref
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * @Accessor(getter="getModified", setter="setModified")
     * @SerializedName("modified")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modified;

    /**
     * Constructor method for preference
     * @param  string $name
     * @param  string $value
     * @param  int   $modified
     * @return self
     */
    public function __construct($name, $value = NULL, $modified = NULL)
    {
        $this->setName($name);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $modified) {
            $this->setModified($modified);
        }
    }

    /**
     * Gets preference name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets preference name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->value = trim($value);
        return $this;
    }

    /**
     * Get preference modified time
     *
     * @return int
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Sets preference modified time
     *
     * @param  int $modified
     * @return self
     */
    public function setModified($modified)
    {
        $this->modified = (int) $modified;
        return $this;
    }
}
