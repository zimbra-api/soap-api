<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

/**
 * CheckDirSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="directory")
 */
class CheckDirSelector
{
    /**
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $_path;

    /**
     * @Accessor(getter="isCreate", setter="setCreate")
     * @SerializedName("create")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_create;

    /**
     * Constructor method for CheckDirSelector
     * @param string $path Full path to the directory
     * @param bool   $create Whether to create the directory or not if it doesn't exist
     * @return self
     */
    public function __construct($path, $create = NULL)
    {
        $this->setPath($path);
        if (NULL !== $create) {
            $this->setCreate($create);
        }
    }

    /**
     * Gets the path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Sets the path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->_path = trim($path);
        return $this;
    }

    /**
     * Gets create flag
     *
     * @return bool
     */
    public function isCreate()
    {
        return $this->_create;
    }

    /**
     * Sets create flag
     *
     * @param  bool $create
     * @return self
     */
    public function setCreate($create)
    {
        $this->_create = (bool) $create;
        return $this;
    }
}
