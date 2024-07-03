<?php
namespace App\Twig;

use App\Service\ColorSchemeService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ColorSchemeExtension extends AbstractExtension
{
    private $colorSchemeService;

    public function __construct(ColorSchemeService $colorSchemeService)
    {
        $this->colorSchemeService = $colorSchemeService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('color_scheme', [$this, 'getColorScheme']),
        ];
    }

    public function getColorScheme()
    {
        return $this->colorSchemeService->getColorScheme();
    }
}