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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * MailQueueWithAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailQueueWithAction
{
    /**
     * Action
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Admin\Struct\MailQueueAction")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private MailQueueAction $action;

    /**
     * Queue name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor method for MailQueueWithAction
     * 
     * @param  MailQueueAction $action
     * @param  string $name
     * @return self
     */
    public function __construct(MailQueueAction $action, string $name = '')
    {
        $this->setAction($action)
             ->setName($name);
    }

    /**
     * Get the action.
     *
     * @return MailQueueAction
     */
    public function getAction(): MailQueueAction
    {
        return $this->action;
    }

    /**
     * Set the action.
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
     * Get the query name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the query name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}
