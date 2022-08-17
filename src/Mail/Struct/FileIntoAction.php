<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * FileIntoAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FileIntoAction extends FilterAction
{
    /**
     * Folder path
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName(name: 'folderPath')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folder;

    /**
     * If true, item will be copied to the new location,
     * leaving the original in place. See https://tools.ietf.org/html/rfc3894
     * "Sieve Extension: Copying Without Side Effects"
     * 
     * @var bool
     */
    #[Accessor(getter: 'isCopy', setter: 'setCopy')]
    #[SerializedName(name: 'copy')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $copy;

    /**
     * Constructor
     * 
     * @param int $index
     * @param string $folder
     * @param bool $copy
     * @return self
     */
    public function __construct(?int $index = NULL, ?string $folder = NULL, ?bool $copy = NULL)
    {
    	parent::__construct($index);
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $copy) {
            $this->setCopy($copy);
        }
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder)
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get copy
     *
     * @return bool
     */
    public function isCopy(): ?bool
    {
        return $this->copy;
    }

    /**
     * Set copy
     *
     * @param  bool $copy
     * @return self
     */
    public function setCopy(bool $copy)
    {
        $this->copy = $copy;
        return $this;
    }
}
