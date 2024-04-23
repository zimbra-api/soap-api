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
use Zimbra\Common\Struct\SoapResponse;

/**
 * SaveDocumentResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SaveDocumentResponse extends SoapResponse
{
    /**
     * Details of saved document revision
     * 
     * @var IdVersionName
     */
    #[Accessor(getter: 'getDoc', setter: 'setDoc')]
    #[SerializedName('doc')]
    #[Type(IdVersionName::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?IdVersionName $doc;

    /**
     * Constructor
     *
     * @param  IdVersionName $doc
     * @return self
     */
    public function __construct(?IdVersionName $doc = null)
    {
        $this->doc = $doc;
    }

    /**
     * Get doc
     *
     * @return IdVersionName
     */
    public function getDoc(): ?IdVersionName
    {
        return $this->doc;
    }

    /**
     * Set doc
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
