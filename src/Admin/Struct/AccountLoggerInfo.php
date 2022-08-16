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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * AccountLoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountLoggerInfo
{
    /**
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Logger information
     * 
     * @var array
     */
    #[Accessor(getter: 'getLoggers', setter: 'setLoggers')]
    #[Type(name: 'array<Zimbra\Admin\Struct\LoggerInfo>')]
    #[XmlList(inline: true, entry: 'logger', namespace: 'urn:zimbraAdmin')]
    private $loggers = [];

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $loggers
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', array $loggers = []
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setLoggers($loggers);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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

    /**
     * Set loggers
     *
     * @param array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = array_filter($loggers, static fn ($logger) => $logger instanceof LoggerInfo);
        return $this;
    }

    /**
     * Get loggers
     *
     * @return array
     */
    public function getLoggers(): array
    {
        return $this->loggers;
    }
}
