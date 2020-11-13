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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * MailQueueWithAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="queue")
 */
class MailQueueWithAction
{
    /**
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Admin\Struct\MailQueueAction")
     * @XmlElement
     */
    private $action;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor method for MailQueueWithAction
     * @param  MailQueueAction $action Action
     * @param  string $name Queue name
     * @return self
     */
    public function __construct(MailQueueAction $action, $name)
    {
        $this->setAction($action)
             ->setName($name);
    }

    /**
     * Gets the action.
     *
     * @return MailQueueAction
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the action.
     *
     * @param  MailQueueAction $action
     * @return self
     */
    public function setAction(MailQueueAction $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Gets the query name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the query name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = trim($name);
        return $this;
    }
}
