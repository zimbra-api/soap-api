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
use Zimbra\Common\Struct\SoapResponse;

/**
 * ImportAppointmentsResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ImportAppointmentsResponse extends SoapResponse
{
    /**
     * List of created IDs
     *
     * @var string
     */
    #[Accessor(getter: "getIds", setter: "setIds")]
    #[SerializedName("ids")]
    #[Type("string")]
    #[XmlAttribute]
    private string $ids;

    /**
     * Number of imported appointments
     *
     * @var int
     */
    #[Accessor(getter: "getNum", setter: "setNum")]
    #[SerializedName("n")]
    #[Type("int")]
    #[XmlAttribute]
    private int $num;

    /**
     * Constructor
     *
     * @param  string $ids
     * @param  int $num
     * @return self
     */
    public function __construct(string $ids = "", int $num = 0)
    {
        $this->setIds($ids)->setNum($num);
    }

    /**
     * Get num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Set num
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
     * Get ids
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * Set ids
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
