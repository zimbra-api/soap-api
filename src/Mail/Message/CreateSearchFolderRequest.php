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
use Zimbra\Mail\Struct\NewSearchFolderSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateSearchFolderRequest class
 * Create a search folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateSearchFolderRequest extends SoapRequest
{
    /**
     * New Search Folder specification
     * 
     * @Accessor(getter="getSearchFolder", setter="setSearchFolder")
     * @SerializedName("search")
     * @Type("Zimbra\Mail\Struct\NewSearchFolderSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var NewSearchFolderSpec
     */
    private $searchFolder;

    /**
     * Constructor
     *
     * @param  NewSearchFolderSpec $searchFolder
     * @return self
     */
    public function __construct(NewSearchFolderSpec $searchFolder)
    {
        $this->setSearchFolder($searchFolder);
    }

    /**
     * Get searchFolder
     *
     * @return NewSearchFolderSpec
     */
    public function getSearchFolder(): NewSearchFolderSpec
    {
        return $this->searchFolder;
    }

    /**
     * Set searchFolder
     *
     * @param  NewSearchFolderSpec $searchFolder
     * @return self
     */
    public function setSearchFolder(NewSearchFolderSpec $searchFolder): self
    {
        $this->searchFolder = $searchFolder;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateSearchFolderEnvelope(
            new CreateSearchFolderBody($this)
        );
    }
}
