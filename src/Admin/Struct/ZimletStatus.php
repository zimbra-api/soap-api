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
use Zimbra\Common\Enum\ZimletStatusSetting;

/**
 * ZimletStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ZimletStatus
{
    /**
     * Zimlet name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Status
     * 
     * @var ZimletStatusSetting
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName('status')]
    #[XmlAttribute]
    private ZimletStatusSetting $status;

    /**
     * Extension
     * 
     * @var bool
     */
    #[Accessor(getter: 'getExtension', setter: 'setExtension')]
    #[SerializedName('extension')]
    #[Type('bool')]
    #[XmlAttribute]
    private $extension;

    /**
     * Priority
     * 
     * @var int
     */
    #[Accessor(getter: 'getPriority', setter: 'setPriority')]
    #[SerializedName('priority')]
    #[Type('int')]
    #[XmlAttribute]
    private $priority;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  ZimletStatusSetting $status
     * @param  bool $extension
     * @param  int $priority
     * @return self
     */
    public function __construct(
        string $name = '',
        ?ZimletStatusSetting $status = null,
        bool $extension = false,
        ?int $priority = null
    )
    {
        $this->setName($name)
             ->setStatus($status ?? ZimletStatusSetting::ENABLED)
             ->setExtension($extension);
        if (null !== $priority) {
            $this->setPriority($priority);
        }
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
     * Get status
     *
     * @return ZimletStatusSetting
     */
    public function getStatus(): ZimletStatusSetting
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  ZimletStatusSetting $status
     * @return self
     */
    public function setStatus(ZimletStatusSetting $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get extension
     *
     * @return bool
     */
    public function getExtension(): bool
    {
        return $this->extension;
    }

    /**
     * Set extension
     *
     * @param  bool $extension
     * @return self
     */
    public function setExtension(bool $extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param  int $priority
     * @return self
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}
