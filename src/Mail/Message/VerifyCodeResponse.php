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
 * VerifyCodeResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VerifyCodeResponse extends SoapResponse
{
    /**
     * Flags whether verification was successful
     *
     * @Accessor(getter="getSuccess", setter="setSuccess")
     * @SerializedName("success")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getSuccess", setter: "setSuccess")]
    #[SerializedName("success")]
    #[Type("bool")]
    #[XmlAttribute]
    private $success = false;

    /**
     * Constructor
     *
     * @param  bool $success
     * @return self
     */
    public function __construct(bool $success = false)
    {
        $this->setSuccess($success);
    }

    /**
     * Get success
     *
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Set success
     *
     * @param  bool $success
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;
        return $this;
    }
}
