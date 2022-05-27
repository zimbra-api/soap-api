<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, XmlAttribute};

/**
 * Request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class Request implements RequestInterface
{
    use WithRequestId;

    /**
     * @var EnvelopeInterface
     * @Exclude
     */
    protected $envelope;

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        $this->envelopeInit();
        return $this->envelope;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    abstract protected function envelopeInit(): void;
}
