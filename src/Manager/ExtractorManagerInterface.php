<?php

/**
 * This file is part of the ksp.
 */

namespace Kematjaya\DataExtractorBundle\Manager;

use Kematjaya\DataExtractorBundle\Extractor\EntityExtractorInterface;

/**
 * @package App\Library\DataExtractor
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface ExtractorManagerInterface {
    
    const KEY_START = '${';
    const KEY_END = '}';
    /**
     * 
     * @param string $content string will be replace with data
     * @param type $object object will be extract
     * @param EntityExtractorInterface $extractor
     * @return string
     */
    public function extractToString(string $content, $object, EntityExtractorInterface $extractor):string;
    
}
