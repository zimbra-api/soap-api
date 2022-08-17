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
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateSearchFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateSearchFolderResponse extends SoapResponse
{
    /**
     * Details of newly created search folder
     * 
     * @var SearchFolder
     */
    #[Accessor(getter: "getSearchFolder", setter: "setSearchFolder")]
    #[SerializedName(name: 'search')]
    #[Type(name: SearchFolder::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $searchFolder;

    /**
     * Constructor
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function __construct(?SearchFolder $searchFolder = NULL)
    {
        if ($searchFolder instanceof SearchFolder) {
            $this->setSearchFolder($searchFolder);
        }
    }

    /**
     * Get searchFolder point
     *
     * @return SearchFolder
     */
    public function getSearchFolder(): ?SearchFolder
    {
        return $this->searchFolder;
    }

    /**
     * Set searchFolder point
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function setSearchFolder(SearchFolder $searchFolder): self
    {
        $this->searchFolder = $searchFolder;
        return $this;
    }
}
