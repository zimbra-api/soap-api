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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * NoOpResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NoOpResponse implements SoapResponseInterface
{
    /**
     * Set if wait was disallowed
     * 
     * @Accessor(getter="getWaitDisallowed", setter="setWaitDisallowed")
     * @SerializedName("waitDisallowed")
     * @Type("bool")
     * @XmlAttribute
     */
    private $waitDisallowed;

    /**
     * Constructor method for NoOpResponse
     *
     * @param  bool $waitDisallowed
     * @return self
     */
    public function __construct(
        ?bool $waitDisallowed = NULL
    )
    {
        if (NULL !== $waitDisallowed) {
            $this->setWaitDisallowed($waitDisallowed);
        }
    }

    /**
     * Get waitDisallowed
     *
     * @return bool
     */
    public function getWaitDisallowed(): ?bool
    {
        return $this->waitDisallowed;
    }

    /**
     * Set waitDisallowed
     *
     * @param  bool $waitDisallowed
     * @return self
     */
    public function setWaitDisallowed(bool $waitDisallowed): self
    {
        $this->waitDisallowed = $waitDisallowed;
        return $this;
    }
}
