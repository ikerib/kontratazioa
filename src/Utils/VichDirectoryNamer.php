<?php

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;


class VichDirectoryNamer implements DirectoryNamerInterface
{
     public function directoryName($object, PropertyMapping $mapping): string
    {
        if ($object->getLotea() !==null) {
            return $object->getLotea();
        }

        return '_lote_gabe';
    }
}
