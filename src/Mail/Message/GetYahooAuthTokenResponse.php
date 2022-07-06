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
use Zimbra\Soap\ResponseInterface;

/**
 * GetYahooAuthTokenResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetYahooAuthTokenResponse implements ResponseInterface
{
    /**
     * Failed
     * 
     * @Accessor(getter="getFailed", setter="setFailed")
     * @SerializedName("failed")
     * @Type("bool")
     * @XmlAttribute
     */
    private $failed;

    /**
     * Constructor method for GetYahooAuthTokenRequest
     *
     * @param  bool $user
     * @return failed
     */
    public function __construct(?bool $failed = NULL)
    {
        if (NULL !== $failed) {
            $this->setFailed($failed);
        }
    }

    /**
     * Gets failed
     *
     * @return bool
     */
    public function getFailed(): ?bool
    {
        return $this->failed;
    }

    /**
     * Sets failed
     *
     * @param  bool $failed
     * @return self
     */
    public function setFailed(bool $failed): self
    {
        $this->failed = $failed;
        return $this;
    }
}
