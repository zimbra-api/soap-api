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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\IdVersionName;
use Zimbra\Soap\ResponseInterface;

/**
 * SaveDocumentResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SaveDocumentResponse implements ResponseInterface
{
    /**
     * Details of saved document revision
     * 
     * @Accessor(getter="getDoc", setter="setDoc")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\IdVersionName")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?IdVersionName $doc = NULL;

    /**
     * Constructor method for SaveDocumentResponse
     *
     * @param  IdVersionName $doc
     * @return self
     */
    public function __construct(?IdVersionName $doc = NULL)
    {
        if ($doc instanceof IdVersionName) {
            $this->setDoc($doc);
        }
    }

    /**
     * Gets doc
     *
     * @return IdVersionName
     */
    public function getDoc(): ?IdVersionName
    {
        return $this->doc;
    }

    /**
     * Sets doc
     *
     * @param  IdVersionName $doc
     * @return self
     */
    public function setDoc(IdVersionName $doc): self
    {
        $this->doc = $doc;
        return $this;
    }
}
