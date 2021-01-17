<?php

/**
 * This file is part of the ksp.
 */

namespace Kematjaya\DataExtractorBundle\Twig;

use Kematjaya\DataExtractorBundle\Manager\ExtractorManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @package App\Library\DataExtractor\Twig
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExtractorExtension extends AbstractExtension
{
    /**
     * 
     * @var ExtractorManagerInterface
     */
    private $extractorManager;
    
    public function __construct(ExtractorManagerInterface $extractorManager) 
    {
        $this->extractorManager = $extractorManager;
    }
    
    public function getFilters()
    {
        return [
            new TwigFilter('extract_to_string', [$this->extractorManager, 'extractToString'], ['is_safe' => ['html']])
        ];
    }
}
