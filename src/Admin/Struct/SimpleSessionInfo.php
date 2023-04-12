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
 * SimpleSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SimpleSessionInfo
{
    /**
     * Account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getZimbraId', setter: 'setZimbraId')]
    #[SerializedName('zid')]
    #[Type('string')]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Account name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Session ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getSessionId', setter: 'setSessionId')]
    #[SerializedName('sid')]
    #[Type('string')]
    #[XmlAttribute]
    private $sessionId;

    /**
     * Creation date
     * 
     * @var int
     */
    #[Accessor(getter: 'getCreatedDate', setter: 'setCreatedDate')]
    #[SerializedName('cd')]
    #[Type('int')]
    #[XmlAttribute]
    private $createdDate;

    /**
     * Last accessed date
     * 
     * @var int
     */
    #[Accessor(getter: 'getLastAccessedDate', setter: 'setLastAccessedDate')]
    #[SerializedName('ld')]
    #[Type('int')]
    #[XmlAttribute]
    private $lastAccessedDate;

    /**
     * Constructor
     *
     * @param string $zimbraId
     * @param string $name
     * @param string $sessionId
     * @param int $createdDate
     * @param int $lastAccessedDate
     * @return self
     */
    public function __construct(
        string $zimbraId = '',
        string $name = '',
        string $sessionId = '',
        int $createdDate = 0,
        int $lastAccessedDate = 0
    )
    {
        $this->setZimbraId($zimbraId)
             ->setName($name)
             ->setSessionId($sessionId)
             ->setCreatedDate($createdDate)
             ->setLastAccessedDate($lastAccessedDate);

    }

    /**
     * Get session ID
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Set session ID
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * Get the createdDate
     *
     * @return int
     */
    public function getCreatedDate(): int
    {
        return $this->createdDate;
    }

    /**
     * Set the createdDate
     *
     * @param  int $createdDate
     * @return self
     */
    public function setCreatedDate(int $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * Get the lastAccessedDate
     *
     * @return int
     */
    public function getLastAccessedDate(): int
    {
        return $this->lastAccessedDate;
    }

    /**
     * Set the lastAccessedDate
     *
     * @param  int $lastAccessedDate
     * @return self
     */
    public function setLastAccessedDate(int $lastAccessedDate): self
    {
        $this->lastAccessedDate = $lastAccessedDate;
        return $this;
    }

    /**
     * Get the zimbraId
     *
     * @return string
     */
    public function getZimbraId(): string
    {
        return $this->zimbraId;
    }

    /**
     * Set the zimbraId
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
