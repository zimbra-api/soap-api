<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\Exclude;

/**
 * Soap request class, not to be instantiated.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class SoapRequest implements RequestInterface
{
    use WithRequestIdTrait;

    /**
     * @var SoapEnvelopeInterface
     * @Exclude
     */
    private ?SoapEnvelopeInterface $soapEnvelope = NULL;

    /**
     * Get soap envelope.
     *
     * @return SoapEnvelopeInterface
     */
    public function getEnvelope(): ?SoapEnvelopeInterface
    {
        if (!($this->soapEnvelope instanceof SoapEnvelopeInterface)) {
            $this->soapEnvelope = $this->envelopeInit();
        }
        return $this->soapEnvelope;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    abstract protected function envelopeInit(): SoapEnvelopeInterface;
}
