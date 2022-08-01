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
 * ConversationTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationTest extends FilterTest
{
    /**
     * Where setting - started|participated
     * @Accessor(getter="getWhere", setter="setWhere")
     * @SerializedName("where")
     * @Type("string")
     * @XmlAttribute
     */
    private $where;

    /**
     * Constructor method for ConversationTest
     * 
     * @param int $index
     * @param bool $negative
     * @param string $where
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $where = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $where) {
            $this->setWhere($where);
        }
    }

    /**
     * Get where
     *
     * @return string
     */
    public function getWhere(): ?string
    {
        return $this->where;
    }

    /**
     * Set where
     *
     * @param  string $where
     * @return self
     */
    public function setWhere(string $where)
    {
        $this->where = $where;
        return $this;
    }
}
