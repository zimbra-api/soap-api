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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlValue};
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GenerateUUIDResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GenerateUUIDResponse implements ResponseInterface
{
    /**
     * Generated globally unique UUID
     * 
     * @Accessor(getter="getUuid", setter="setUuid")
     * @Type("string")
     * @XmlValue
     */
    private $uuid;

    /**
     * Constructor method for GenerateUUIDResponse
     *
     * @param  string $uuid
     * @return self
     */
    public function __construct(string $uuid = '')
    {
        $this->setUuid($uuid);
    }

    /**
     * Gets uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Sets uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }
}
