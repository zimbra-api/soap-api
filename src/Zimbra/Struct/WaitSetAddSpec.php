<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\InterestType;

/**
 * WaitSetAddSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="a")
 */
class WaitSetAddSpec
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $_token;

    /**
     * @Accessor(getter="getInterests", setter="setInterests")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $_interests;

    /**
     * @Exclude
     */
    private $_folderInterests = [];

    /**
     * Constructor method for waitSetAddSpec
     * @param string $name The name
     * @param string $id The id
     * @param string $token Last known sync token
     * @param string $interests Comma-separated list
     * @return self
     */
    public function __construct(
        $name = NULL,
        $id = NULL,
        $token = NULL,
        $interests = NULL
    )
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $token) {
            $this->setToken($token);
        }
        $this->setInterests($interests);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets Id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets the token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Sets the token
     *
     * @param  string $token
     * @return self
     */
    public function setToken($token)
    {
        $this->_token = trim($token);
        return $this;
    }

    /**
     * Sets interests
     *
     * @param string $interests Comma-separated list
     * @return self
     */
    public function setInterests($interests)
    {
        $types = [];
        if (is_array($interests)) {
            foreach ($interests as $type) {
                if (InterestType::has($type)) {
                    $types[] = $type;
                }
            }
        }
        else {
            $values = explode(',', $interests);
            foreach ($values as $type) {
                if (InterestType::has($type)) {
                    $types[] = $type;
                }
            }
        }
        $this->_interests = !empty($types) ? implode(',', $types) : NULL;
        return $this;
    }

    /**
     * Gets interests
     *
     * @return string
     */
    public function getInterests()
    {
        return $this->_interests;
    }

    public function addFolderInterest($folderId)
    {
        $folderId = (int) $folderId;
        if (!in_array($folderId, $this->_folderInterests)) {
            $this->_folderInterests = $folderId;
        }
        return $this;
    }

    public function setFolderInterests($folderInterests)
    {
        $this->_folderInterests = [];
        if (is_array($folderInterests)) {
            foreach ($folderInterests as $folderId) {
                $this->addFolderInterest($folderId);
            }
        }
        else {
            $values = explode(',', $folderInterests);
            foreach ($values as $folderId) {
                $this->addFolderInterest($folderId);
            }
        }
        return $this;
    }

    /**
     * @VirtualProperty
     * @Type("string")
     * @SerializedName("folderInterests")
     * @SkipWhenEmpty
     * @XmlAttribute
     *
     * @return string
     */
    public function getFolderInterests()
    {
        return !empty($this->_folderInterests) ? implode(',', $this->_folderInterests) : NULL;
    }
}
