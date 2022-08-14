<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * FilterAction class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FilterAction
{
    /**
     * Index - specifies a guaranteed order for the action elements
     * 
     * @Accessor(getter="getIndex", setter="setIndex")
     * @SerializedName("index")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getIndex', setter: 'setIndex')]
    #[SerializedName(name: 'index')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $index;

    /**
     * Constructor
     * 
     * @param int $index
     * @return self
     */
    public function __construct(?int $index = NULL)
    {
        if (NULL !== $index) {
            $this->setIndex($index);
        }
    }

    /**
     * Get index
     *
     * @return int
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * Set index
     *
     * @param  int $index
     * @return self
     */
    public function setIndex(int $index)
    {
        $this->index = $index;
        return $this;
    }
}
