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

/**
 * AccountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="account")
 */
class AccountInfo extends AdminObjectInfo
{
    /**
     * @Accessor(getter="getIsExternal", setter="setIsExternal")
     * @SerializedName("isExternal")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_isExternal;

    /**
     * Constructor method for AccountInfo
     * 
     * @param  string $name Name
     * @param  string $id ID
     * @param  string $isExternal Is external
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct($name, $id, $isExternal = NULL, array $attrs = [])
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
    public function getIsExternal()
    {
        return $this->_isExternal;
    }

    /**
     * Sets is external
     *
     * @param  bool $isExternal
     * @return self
     */
    public function setIsExternal($isExternal)
    {
        $this->_isExternal = (bool) $isExternal;
        return $this;
    }
}
