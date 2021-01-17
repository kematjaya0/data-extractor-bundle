<?php

/**
 * This file is part of the ksp.
 */

namespace Kematjaya\DataExtractorBundle\Manager;

use Kematjaya\DataExtractorBundle\Extractor\EntityExtractorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * @package App\Library\DataExtractor
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExtractorManager implements ExtractorManagerInterface
{
    
    public function extractToString(string $content, $object, EntityExtractorInterface $extractor):string
    {
        $data = $extractor->extract($object);
        $accessor = PropertyAccess::createPropertyAccessor();
        $keys = $this->findKey($content, self::KEY_START, self::KEY_END);
        foreach ($keys as $key) {
            $keys = sprintf('[%s]', $key);
            if (!$accessor->isReadable($data, $keys)) {
                continue;
            }
            
            $value = $accessor->getValue($data, $keys);
            if (null === $value) {
                continue;
            }
            
            $index = sprintf('%s%s%s', self::KEY_START, $key, self::KEY_END);
            $content = str_replace($index, $value, $content);
        }
        
        return $content;
    }
    
    protected function findKey(string $content, string $start, string $end, array $result = []):array
    {
        $startPos = strpos($content, $start);
        if (false === $startPos) {
            return $result;
        }
        
        $length = (strpos($content, $end) - strlen($end)) - ($startPos - strlen($start));
        $subStr = substr($content, $startPos, $length);
        $key        = trim(str_replace($end, "", str_replace($start, "", $subStr)));
        $result[]   = $key;
        $newString  = trim(str_replace($subStr, "", strstr($content, $subStr)));
        if (strlen($newString) > 0) {
            
            return $this->findKey($newString, $start, $end, $result);
        }
        
        return $result;
    }
}
