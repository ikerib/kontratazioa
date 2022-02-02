<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FitxategiaRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ApiResource()
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=FitxategiaRepository::class)
 */
class Fitxategia
{
    Use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="uploads", fileNameProperty="fileName", size="fileSize")
     *
     * @var File|null
     */
    private $uploadFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $fileName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $fileSize;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $uploadFile
     */
    public function setUploadFile(?File $uploadFile = null): void
    {
        $this->uploadFile = $uploadFile;

        if (null !== $uploadFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getUploadFile(): ?File
    {
        return $this->uploadFile;
    }

    /**
     * @ORM\ManyToOne(targetEntity=FitxategiMota::class, inversedBy="fitxategiak")
     */
    private $fitxategimota;

    /**
     * @ORM\ManyToOne(targetEntity=Kontratua::class, inversedBy="fitxategiak", cascade={"persist"})
     */
    private $kontratua;

    /**
     * @ORM\ManyToOne(targetEntity=KontratuaLote::class, inversedBy="fitxategiak")
     */
    private $lotea;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFitxategimota(): ?FitxategiMota
    {
        return $this->fitxategimota;
    }

    public function setFitxategimota(?FitxategiMota $fitxategimota): self
    {
        $this->fitxategimota = $fitxategimota;

        return $this;
    }

    public function getKontratua(): ?Kontratua
    {
        return $this->kontratua;
    }

    public function setKontratua(?Kontratua $kontratua): self
    {
        $this->kontratua = $kontratua;

        return $this;
    }

    public function getLotea(): ?KontratuaLote
    {
        return $this->lotea;
    }

    public function setLotea(?KontratuaLote $lotea): self
    {
        $this->lotea = $lotea;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }
}
