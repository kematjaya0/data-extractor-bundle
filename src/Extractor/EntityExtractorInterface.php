<?php

/**
 * This file is part of the ksp.
 */

namespace Kematjaya\DataExtractorBundle\Extractor;

/**
 * @package App\Library\DataExtractor\Extractor
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface EntityExtractorInterface 
{
    public function extract($object):array;
}
