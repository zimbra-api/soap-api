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
use Zimbra\Mail\Struct\ModifySearchFolderSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifySearchFolderRequest class
 * Modify Search Folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifySearchFolderRequest extends SoapRequest
{
    /**
     * Specification of Search folder modifications
     * 
     * @Accessor(getter="getSearchFolder", setter="setSearchFolder")
     * @SerializedName("search")
     * @Type("Zimbra\Mail\Struct\ModifySearchFolderSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ModifySearchFolderSpec $searchFolder;

    /**
     * Constructor method for ModifySearchFolderRequest
     *
     * @param  ModifySearchFolderSpec $searchFolder
     * @return self
     */
    public function __construct(ModifySearchFolderSpec $searchFolder)
    {
        $this->setSearchFolder($searchFolder);
    }

    /**
     * Gets searchFolder
     *
     * @return ModifySearchFolderSpec
     */
    public function getSearchFolder(): ModifySearchFolderSpec
    {
        return $this->searchFolder;
    }

    /**
     * Sets searchFolder
     *
     * @param  ModifySearchFolderSpec $searchFolder
     * @return self
     */
    public function setSearchFolder(ModifySearchFolderSpec $searchFolder): self
    {
        $this->searchFolder = $searchFolder;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifySearchFolderEnvelope(
            new ModifySearchFolderBody($this)
        );
    }
}
