<?php

namespace App\Factory;

use App\Entity\Saila;
use App\Repository\SailaRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Saila>
 *
 * @method static Saila|Proxy createOne(array $attributes = [])
 * @method static Saila[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Saila|Proxy find(object|array|mixed $criteria)
 * @method static Saila|Proxy findOrCreate(array $attributes)
 * @method static Saila|Proxy first(string $sortedField = 'id')
 * @method static Saila|Proxy last(string $sortedField = 'id')
 * @method static Saila|Proxy random(array $attributes = [])
 * @method static Saila|Proxy randomOrCreate(array $attributes = [])
 * @method static Saila[]|Proxy[] all()
 * @method static Saila[]|Proxy[] findBy(array $attributes)
 * @method static Saila[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Saila[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SailaRepository|RepositoryProxy repository()
 * @method Saila|Proxy create(array|callable $attributes = [])
 */
final class SailaFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'izena' => self::faker()->text('15'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Saila $saila) {})
        ;
    }

    protected static function getClass(): string
    {
        return Saila::class;
    }
}
