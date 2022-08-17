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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * IdAndAction struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IdAndAction
{
    /**
     * Zimbra ID of account
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * bug72174 or wiki or contactGroup
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName(name: 'action')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $action;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $action
     * @return self
     */
    public function __construct(string $id = '', string $action = '')
    {
        $this->setId($id)
             ->setAction($action);
    }

    /**
     * Get Zimbra ID of account
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set Zimbra ID of account
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $action = trim($action);
        if (in_array($action, ['bug72174', 'wiki', 'contactGroup'])) {
            $this->action = $action;
        }
        return $this;
    }
}
