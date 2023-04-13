<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * NewNoteSpec class
 * Input for creating a new note
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewNoteSpec
{
    /**
     * Parent Folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folder;

    /**
     * Content
     * 
     * @var string
     */
    #[Accessor(getter: 'getContent', setter: 'setContent')]
    #[SerializedName('content')]
    #[Type('string')]
    #[XmlAttribute]
    private $content;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * 
     * @var int
     */
    #[Accessor(getter: 'getColor', setter: 'setColor')]
    #[SerializedName('color')]
    #[Type('int')]
    #[XmlAttribute]
    private $color;

    /**
     * Bounds - x,y[width,height] where x,y,width and height are all ints
     * 
     * @var string
     */
    #[Accessor(getter: 'getBounds', setter: 'setBounds')]
    #[SerializedName('pos')]
    #[Type('string')]
    #[XmlAttribute]
    private $bounds;

    /**
     * Constructor
     *
     * @param  string $folder
     * @param  string $content
     * @param  int $color
     * @param  string $bounds
     * @return self
     */
    public function __construct(
        string $folder = '',
        string $content = '',
        ?int $color = NULL,
        ?string $bounds = NULL
    )
    {
        $this->setFolder($folder)
             ->setContent($content);
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $bounds) {
            $this->setBounds($bounds);
        }
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get bounds
     *
     * @return string
     */
    public function getBounds(): ?string
    {
        return $this->bounds;
    }

    /**
     * Set bounds
     *
     * @param  string $bounds
     * @return self
     */
    public function setBounds(string $bounds): self
    {
        $this->bounds = $bounds;
        return $this;
    }
}
