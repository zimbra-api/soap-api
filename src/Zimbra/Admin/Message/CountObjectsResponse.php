<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * CountObjectsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CountObjectsResponse")
 */
class CountObjectsResponse implements ResponseInterface
{
    /**
     * Number of objects of the requested type
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("num")
     * @Type("int")
     * @XmlAttribute
     */
    private $num;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Constructor method for CountObjectsResponse
     * 
     * @param int  $num
     * @param string  $type
     * @return self
     */
    public function __construct(int $num, string $type)
    {
        $this->setNum($num)
             ->setType($type);
    }

    /**
     * Gets num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Sets num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Gets type
     *
     * @return Status
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
