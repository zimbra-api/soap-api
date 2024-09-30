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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Mail\Struct\GetFolderSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetFolderRequest class
 * Get folder
 *
 * A {base-folder-id}, a {base-folder-uuid} or a {fully-qualified-path} can optionally be specified in the folder element;
 * if none is present, the descent of the folder hierarchy begins at the mailbox's root folder (id 1).
 *
 * If {fully-qualified-path} is present and {base-folder-id} or {base-folder-uuid} is also present,
 * the path is treated as relative to the folder that was specified by id/uuid.
 * {base-folder-id} is ignored if {base-folder-uuid} is present.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetFolderRequest extends SoapRequest
{
    /**
     * If set we include all visible subfolders of the specified folder.
     *
     * @var bool
     */
    #[Accessor(getter: "isVisible", setter: "setVisible")]
    #[SerializedName("visible")]
    #[Type("bool")]
    #[XmlAttribute]
    private $isVisible;

    /**
     * If set then grantee names are supplied in the "d" attribute in <grant>.
     *
     * @var bool
     */
    #[Accessor(getter: "isNeedGranteeName", setter: "setNeedGranteeName")]
    #[SerializedName("needGranteeName")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needGranteeName;

    /**
     * If "view" is set then only the folders with matching view will be returned.
     * Otherwise folders with any default views will be returned.
     *
     * @var string
     */
    #[Accessor(getter: "getViewConstraint", setter: "setViewConstraint")]
    #[SerializedName("view")]
    #[Type("string")]
    #[XmlAttribute]
    private $viewConstraint;

    /**
     * If "depth" is set to a non-negative number, we include that many levels of subfolders in the response.
     * (so if depth="1", we'll include only the folder and its direct subfolders)
     * If depth is missing or negative, the entire folder hierarchy is returned
     *
     * @var int
     */
    #[Accessor(getter: "getTreeDepth", setter: "setTreeDepth")]
    #[SerializedName("depth")]
    #[Type("int")]
    #[XmlAttribute]
    private $treeDepth;

    /**
     * If true, one level of mountpoints are traversed and the target folder's counts are applied to the local mountpoint.
     * If the root folder as referenced by {base-folder-id} and/or {fully-qualified-path} is a mountpoint,
     * "tr" is regarded as being automatically set.
     * Mountpoints under mountpoints are not themselves expanded.
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "isTraverseMountpoints",
            setter: "setTraverseMountpoints"
        )
    ]
    #[SerializedName("tr")]
    #[Type("bool")]
    #[XmlAttribute]
    private $traverseMountpoints;

    /**
     * Folder specification
     *
     * @var GetFolderSpec
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("folder")]
    #[Type(GetFolderSpec::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?GetFolderSpec $folder;

    /**
     * Constructor
     *
     * @param  GetFolderSpec $folder
     * @param  bool $isVisible
     * @param  bool $needGranteeName
     * @param  string $viewConstraint
     * @param  int $treeDepth
     * @param  bool $traverseMountpoints
     * @return self
     */
    public function __construct(
        ?GetFolderSpec $folder = null,
        ?bool $isVisible = null,
        ?bool $needGranteeName = null,
        ?string $viewConstraint = null,
        ?int $treeDepth = null,
        ?bool $traverseMountpoints = null
    ) {
        $this->folder = $folder;
        if (null !== $isVisible) {
            $this->setVisible($isVisible);
        }
        if (null !== $needGranteeName) {
            $this->setNeedGranteeName($needGranteeName);
        }
        if (null !== $viewConstraint) {
            $this->setViewConstraint($viewConstraint);
        }
        if (null !== $treeDepth) {
            $this->setTreeDepth($treeDepth);
        }
        if (null !== $traverseMountpoints) {
            $this->setTraverseMountpoints($traverseMountpoints);
        }
    }

    /**
     * Get folder
     *
     * @return GetFolderSpec
     */
    public function getFolder(): ?GetFolderSpec
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  GetFolderSpec $folder
     * @return self
     */
    public function setFolder(GetFolderSpec $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get isVisible
     *
     * @return bool
     */
    public function isVisible(): ?bool
    {
        return $this->isVisible;
    }

    /**
     * Set isVisible
     *
     * @param  bool $isVisible
     * @return self
     */
    public function setVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * Get needGranteeName
     *
     * @return bool
     */
    public function isNeedGranteeName(): ?bool
    {
        return $this->needGranteeName;
    }

    /**
     * Set needGranteeName
     *
     * @param  bool $needGranteeName
     * @return self
     */
    public function setNeedGranteeName(bool $needGranteeName): self
    {
        $this->needGranteeName = $needGranteeName;
        return $this;
    }

    /**
     * Get viewConstraint
     *
     * @return string
     */
    public function getViewConstraint(): ?string
    {
        return $this->viewConstraint;
    }

    /**
     * Set viewConstraint
     *
     * @param  string $viewConstraint
     * @return self
     */
    public function setViewConstraint(string $viewConstraint): self
    {
        $this->viewConstraint = $viewConstraint;
        return $this;
    }

    /**
     * Get treeDepth
     *
     * @return int
     */
    public function getTreeDepth(): ?int
    {
        return $this->treeDepth;
    }

    /**
     * Set treeDepth
     *
     * @param  int $treeDepth
     * @return self
     */
    public function setTreeDepth(int $treeDepth): self
    {
        $this->treeDepth = $treeDepth;
        return $this;
    }

    /**
     * Get traverseMountpoints
     *
     * @return bool
     */
    public function isTraverseMountpoints(): ?bool
    {
        return $this->traverseMountpoints;
    }

    /**
     * Set traverseMountpoints
     *
     * @param  bool $traverseMountpoints
     * @return self
     */
    public function setTraverseMountpoints(bool $traverseMountpoints): self
    {
        $this->traverseMountpoints = $traverseMountpoints;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetFolderEnvelope(new GetFolderBody($this));
    }
}
