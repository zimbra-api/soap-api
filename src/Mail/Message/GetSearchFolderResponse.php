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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetSearchFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSearchFolderResponse extends SoapResponse
{
    /**
     * Search folder information
     * 
     * @var array
     */
    #[Accessor(getter: 'getSearchFolders', setter: 'setSearchFolders')]
    #[Type('array<Zimbra\Mail\Struct\SearchFolder>')]
    #[XmlList(inline: true, entry: 'search', namespace: 'urn:zimbraMail')]
    private $searchFolders = [];

    /**
     * Constructor
     *
     * @param  array $searchFolders
     * @return self
     */
    public function __construct(array $searchFolders = [])
    {
        $this->setSearchFolders($searchFolders);
    }

    /**
     * Set search folders
     *
     * @param  array $folders
     * @return self
     */
    public function setSearchFolders(array $folders): self
    {
        $this->searchFolders = array_filter(
            $folders, static fn ($folder) => $folder instanceof SearchFolder
        );
        return $this;
    }

    /**
     * Get search folders
     *
     * @return array
     */
    public function getSearchFolders(): array
    {
        return $this->searchFolders;
    }
}
