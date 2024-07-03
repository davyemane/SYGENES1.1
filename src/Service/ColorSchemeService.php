<?php
namespace App\Service;

use App\Entity\ColorScheme;
use Doctrine\ORM\EntityManagerInterface;

class ColorSchemeService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getColorScheme(): ColorScheme
    {
        $colorScheme = $this->entityManager->getRepository(ColorScheme::class)->findOneBy([]);
        
        if (!$colorScheme) {
            $colorScheme = new ColorScheme();
            $colorScheme->setPrimaryColor('#ea4335');
            $colorScheme->setSecondaryColor('#1a73e8');
            $colorScheme->setAccentColor('#fbbc05');
            $colorScheme->setBacgroundColor('#ffffff');
            $colorScheme->setTextColor('#5f6368');
            $this->entityManager->persist($colorScheme);
            $this->entityManager->flush();
        }

        return $colorScheme;
    }

    public function updateColorScheme(array $colors): void
    {
        $colorScheme = $this->getColorScheme();
        
        if (isset($colors['primary'])) $colorScheme->setPrimaryColor($colors['primary']);
        if (isset($colors['secondary'])) $colorScheme->setSecondaryColor($colors['secondary']);
        if (isset($colors['accent'])) $colorScheme->setAccentColor($colors['accent']);
        if (isset($colors['background'])) $colorScheme->setBacgroundColor($colors['background']);
        if (isset($colors['text'])) $colorScheme->setTextColor($colors['text']);

        $this->entityManager->flush();
    }
}