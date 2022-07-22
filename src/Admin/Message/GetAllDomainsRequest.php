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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetAllDomainsRequest class
 * Get all domains
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllDomainsRequest extends Request
{
    /**
     * Apply config flag
     * @Accessor(getter="isApplyConfig", setter="setApplyConfig")
     * @SerializedName("applyConfig")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyConfig;

    /**
     * Constructor method for GetAllDomainsRequest
     * 
     * @param  bool $applyConfig
     * @return self
     */
    public function __construct(?bool $applyConfig = NULL)
    {
        if (NULL !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
        }
    }

    /**
     * Gets applyConfig
     *
     * @return bool
     */
    public function isApplyConfig(): ?bool
    {
        return $this->applyConfig;
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig(bool $applyConfig): self
    {
        $this->applyConfig = $applyConfig;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetAllDomainsEnvelope(
            new GetAllDomainsBody($this)
        );
    }
}
