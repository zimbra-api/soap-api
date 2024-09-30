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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAppointmentIdsSinceResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAppointmentIdsSinceResponse extends SoapResponse
{
    /**
     * Appointment data
     *
     * @var array
     */
    #[Accessor(getter: "getMids", setter: "setMids")]
    #[Type("array<int>")]
    #[XmlList(inline: true, entry: "mids", namespace: "urn:zimbraMail")]
    private $mids = [];

    /**
     * Appointment data
     *
     * @var array
     */
    #[Accessor(getter: "getDids", setter: "setDids")]
    #[Type("array<int>")]
    #[XmlList(inline: true, entry: "dids", namespace: "urn:zimbraMail")]
    private $dids = [];

    /**
     * Constructor
     *
     * @param  array $mids
     * @param  array $mids
     * @return self
     */
    public function __construct(array $mids = [], array $dids = [])
    {
        $this->setMids($mids)->setDids($dids);
    }

    /**
     * Set mids
     *
     * @param  array $mids
     * @return self
     */
    public function setMids(array $mids): self
    {
        $this->mids = array_unique($mids);
        return $this;
    }

    /**
     * Get mids
     *
     * @return array
     */
    public function getMids(): array
    {
        return $this->mids;
    }

    /**
     * Set dids
     *
     * @param  array $dids
     * @return self
     */
    public function setDids(array $dids): self
    {
        $this->dids = array_unique($dids);
        return $this;
    }

    /**
     * Get dids
     *
     * @return array
     */
    public function getDids(): array
    {
        return $this->dids;
    }
}
