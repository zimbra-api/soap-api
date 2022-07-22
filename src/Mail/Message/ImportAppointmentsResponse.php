<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\ResponseInterface;

/**
 * ImportAppointmentsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ImportAppointmentsResponse implements ResponseInterface
{
    /**
     * List of created IDs
     * 
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $ids;

    /**
     * Number of imported appointments
     * 
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $num;

    /**
     * Constructor method for ImportAppointmentsRequest
     *
     * @param  string $ids
     * @param  int $num
     * @return self
     */
    public function __construct(
        string $ids = '', int $num = 0
    )
    {
        $this->setIds($ids)
             ->setNum($num);
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
     * Gets ids
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * Sets ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;
        return $this;
    }
}
