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
 * DestroyWaitSetResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DestroyWaitSetResponse extends SoapResponse
{
    /**
     * WaitSet ID
     *
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getWaitSetId", setter: "setWaitSetId")]
    #[SerializedName("waitSet")]
    #[Type("string")]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * Constructor
     *
     * @param  string $waitSetId
     * @return self
     */
    public function __construct(string $waitSetId = "")
    {
        $this->setWaitSetId($waitSetId);
    }

    /**
     * Get waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): string
    {
        return $this->waitSetId;
    }

    /**
     * Set waitSetId
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }
}
