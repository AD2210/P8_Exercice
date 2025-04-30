<?php

namespace App\Factory;

use App\Entity\Voiture;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Voiture>
 */
final class VoitureFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Voiture::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * 
     */
    protected function defaults(): array|callable
    {
        return [
            'dailly_price' => self::faker()->randomFloat(2, 30, 50),
            'description' => self::faker()->text(100),
            'gearbox_type' => self::faker()->boolean(),
            'monthly_price' => self::faker()->randomFloat(2, 750, 1000),
            'name' => self::faker()->name(),
            'seats' => self::faker()->numberBetween(1, 9),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }
}
