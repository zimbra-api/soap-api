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
 * CheckHealthResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckHealthResponse")
 */
class CheckHealthResponse implements ResponseInterface
{
    /**
     * Flags whether healthy or not
     * @Accessor(getter="isHealthy", setter="setHealthy")
     * @SerializedName("healthy")
     * @Type("bool")
     * @XmlAttribute
     */
    private $healthy;

    /**
     * Constructor method for CheckHealthResponse
     * 
     * @param bool  $healthy
     * @return self
     */
    public function __construct($healthy)
    {
        $this->setHealthy($healthy);
    }

    /**
     * Gets healthy
     *
     * @return bool
     */
    public function isHealthy(): ?bool
    {
        return $this->healthy;
    }

    /**
     * Sets healthy
     *
     * @param  bool $healthy
     * @return self
     */
    public function setHealthy($healthy): self
    {
        $this->healthy = (bool) $healthy;
        return $this;
    }
}
