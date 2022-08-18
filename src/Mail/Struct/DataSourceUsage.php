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
 * DataSourceUsage struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DataSourceUsage
{
    /**
     * ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Usage
     * 
     * @var int
     */
    #[Accessor(getter: 'getUsage', setter: 'setUsage')]
    #[SerializedName('usage')]
    #[Type('int')]
    #[XmlAttribute]
    private $usage;

    /**
     * Constructor
     * 
     * @param string $id
     * @param int $usage
     * @return self
     */
    public function __construct(string $id = '', int $usage = 0)
    {
        $this->setId($id)
             ->setUsage($usage);
    }

    /**
     * Get usage
     *
     * @return int
     */
    public function getUsage(): ?int
    {
        return $this->usage;
    }

    /**
     * Set usage
     *
     * @param  int $usage
     * @return self
     */
    public function setUsage(int $usage): self
    {
        $this->usage = $usage;
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
