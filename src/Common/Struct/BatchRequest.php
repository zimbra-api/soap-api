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
use Zimbra\Common\Enum\OnError;

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
     * @Type("Zimbra\Common\Enum\OnError")
     * @XmlAttribute
     */
    private ?OnError $onerror = NULL;

    /**
     * Constructor
     * 
     * @param array   $requests
     * @param OnError $onerror
     * @return self
     */
    public function __construct(array $requests = [], ?OnError $onerror = NULL)
    {
        $this->setOnError($onerror ?? OnError::CONTINUE())
             ->setRequests($requests);
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
     * @return OnError
     */
    public function getOnError(): OnError
    {
        return $this->onerror;
    }

    /**
     * Set on error
     *
     * @param  OnError $onerror
     * @return self
     */
    public function setOnError(OnError $onerror): self
    {
        $this->onerror = $onerror;
        return $this;
    }
}
