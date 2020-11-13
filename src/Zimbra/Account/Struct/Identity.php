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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * Identity struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="identity")
 */
class Identity extends AttrsImpl
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for Identity
     * @param string $name
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct($name = NULL, $id = NULL, array $attrs = array())
    {
        parent::__construct($attrs);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Gets identity name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets identity name
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
     * Gets identity ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets identity ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = trim($id);
        return $this;
    }
}
