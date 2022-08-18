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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckHealthResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckHealthResponse extends SoapResponse
{
    /**
     * Flags whether healthy or not
     * 
     * @Accessor(getter="isHealthy", setter="setHealthy")
     * @SerializedName("healthy")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isHealthy', setter: 'setHealthy')]
    #[SerializedName('healthy')]
    #[Type('bool')]
    #[XmlAttribute]
    private $healthy;

    /**
     * Constructor
     * 
     * @param bool $healthy
     * @return self
     */
    public function __construct(bool $healthy = FALSE)
    {
        $this->setHealthy($healthy);
    }

    /**
     * Get healthy
     *
     * @return bool
     */
    public function isHealthy(): bool
    {
        return $this->healthy;
    }

    /**
     * Set healthy
     *
     * @param  bool $healthy
     * @return self
     */
    public function setHealthy(bool $healthy): self
    {
        $this->healthy = $healthy;
        return $this;
    }
}
