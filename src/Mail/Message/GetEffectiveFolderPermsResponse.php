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
use Zimbra\Mail\Struct\Rights;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetEffectiveFolderPermsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetEffectiveFolderPermsResponse implements SoapResponseInterface
{
    /**
     * Folder permissions information
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Rights")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Rights $folder = NULL;

    /**
     * Constructor method for GetEffectiveFolderPermsResponse
     *
     * @param  Rights $folder
     * @return self
     */
    public function __construct(?Rights $folder = NULL)
    {
        if ($folder instanceof Rights) {
            $this->setFolder($folder);
        }
    }

    /**
     * Get folder
     *
     * @return Rights
     */
    public function getFolder(): ?Rights
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  Rights $folder
     * @return self
     */
    public function setFolder(Rights $folder): self
    {
        $this->folder = $folder;
        return $this;
    }
}
