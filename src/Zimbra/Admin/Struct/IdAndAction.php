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
 * IdAndAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="ia")
 */
class IdAndAction
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $_id;

    /**
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("string")
     * @XmlAttribute
     */
    private $_action;

    /**
     * Constructor method for IdAndAction
     * @param string $id Zimbra ID of account
     * @param string $action bug72174 or wiki or contactGroup
     * @return self
     */
    public function __construct($id, $action)
    {
        $this->setId($id)
             ->setAction($action);
    }

    /**
     * Gets Zimbra ID of account
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets Zimbra ID of account
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
     * Gets action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction($action)
    {
        $action = trim($action);
        if (in_array($action, ['bug72174', 'wiki', 'contactGroup'])) {
            $this->_action = $action;
        }
        return $this;
    }
}
