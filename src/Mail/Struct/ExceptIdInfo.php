<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ExceptIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExceptIdInfo
{
    /**
     * Recurrence ID of exception
     *
     * @var string
     */
    #[Accessor(getter: "getRecurrenceId", setter: "setRecurrenceId")]
    #[SerializedName("recurId")]
    #[Type("string")]
    #[XmlAttribute]
    private string $recurrenceId;

    /**
     * Invite ID of exception
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Constructor
     *
     * @param string $recurrenceId
     * @param string $id
     * @return self
     */
    public function __construct(string $recurrenceId = "", string $id = "")
    {
        $this->setRecurrenceId($recurrenceId)->setId($id);
    }

    /**
     * Get recurrenceId
     *
     * @return string
     */
    public function getRecurrenceId(): string
    {
        return $this->recurrenceId;
    }

    /**
     * Set recurrenceId
     *
     * @param  string $recurrenceId
     * @return self
     */
    public function setRecurrenceId(string $recurrenceId): self
    {
        $this->recurrenceId = $recurrenceId;
        return $this;
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
