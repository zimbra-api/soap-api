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

use JMS\Serializer\Annotation\{Accessor, Type, SerializedName, XmlAttribute};

/**
 * Batch request class, not to be instantiated.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class BatchRequest extends SoapRequest implements BatchRequestInterface
{
    /**
     * @Accessor(getter="getOnError", setter="setOnError")
     * @SerializedName("onerror")
     * @Type("string")
     * @XmlAttribute
     */
    private $onerror = 'continue';

    /**
     * Constructor
     * 
     * @param array  $requests
     * @param string $onerror
     * @return self
     */
    public function __construct(array $requests = [], string $onerror = 'continue')
    {
        $this->setRequests($requests)
             ->setOnError($onerror);
    }

    /**
     * Set the soap requests
     *
     * @return self
     */
    abstract public function setRequests(array $requests): self;

    /**
     * Get on error
     *
     * @return string
     */
    public function getOnError(): string
    {
        return $this->onerror;
    }

    /**
     * Set on error
     *
     * @param  string $onerror
     * @return self
     */
    public function setOnError(string $onerror): self
    {
        $onerror = strtolower($onerror);
        if (!in_array($onerror, ['continue', 'stop'])) {
            $onerror = 'continue';
        }
        $this->onerror = $onerror;
        return $this;
    }
}
