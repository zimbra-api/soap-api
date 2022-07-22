<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use JMS\Serializer\Annotation\Exclude;

/**
 * Request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class Request implements RequestInterface
{
    use WithRequestIdTrait;

    /**
     * @var EnvelopeInterface
     * @Exclude
     */
    private ?EnvelopeInterface $soapEnvelope = NULL;

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): ?EnvelopeInterface
    {
        if (NULL == $this->soapEnvelope) {
            $this->soapEnvelope = $this->envelopeInit();
        }
        return $this->soapEnvelope;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    abstract protected function envelopeInit(): EnvelopeInterface;
}
