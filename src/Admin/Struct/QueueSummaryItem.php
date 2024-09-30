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
 * QueueSummaryItem class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueueSummaryItem
{
    /**
     * Count
     *
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("n")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getCount", setter: "setCount")]
    #[SerializedName("n")]
    #[Type("int")]
    #[XmlAttribute]
    private $count;

    /**
     * Text for item.  e.g. "connect to 10.10.20.40 failed"
     *
     * @Accessor(getter="getTerm", setter="setTerm")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTerm", setter: "setTerm")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private $term;

    /**
     * Constructor
     *
     * @param int $count
     * @param string $term
     * @return self
     */
    public function __construct(int $count = 0, string $term = "")
    {
        $this->setCount($count)->setTerm($term);
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Set count
     *
     * @param  int $count
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Get term
     *
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * Set term
     *
     * @param  string $term
     * @return self
     */
    public function setTerm(string $term): self
    {
        $this->term = $term;
        return $this;
    }
}
