<?php

namespace App\Factory;

use App\Entity\Prozedura;
use App\Repository\ProzeduraRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Prozedura>
 *
 * @method static Prozedura|Proxy createOne(array $attributes = [])
 * @method static Prozedura[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Prozedura|Proxy find(object|array|mixed $criteria)
 * @method static Prozedura|Proxy findOrCreate(array $attributes)
 * @method static Prozedura|Proxy first(string $sortedField = 'id')
 * @method static Prozedura|Proxy last(string $sortedField = 'id')
 * @method static Prozedura|Proxy random(array $attributes = [])
 * @method static Prozedura|Proxy randomOrCreate(array $attributes = [])
 * @method static Prozedura[]|Proxy[] all()
 * @method static Prozedura[]|Proxy[] findBy(array $attributes)
 * @method static Prozedura[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Prozedura[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProzeduraRepository|RepositoryProxy repository()
 * @method Prozedura|Proxy create(array|callable $attributes = [])
 */
final class ProzeduraFactory extends ModelFactory
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
            'prozedura_eus' => self::faker()->realText(25),
            'prozedura_es' => self::faker()->realText(25),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Prozedura $prozedura) {})
        ;
    }

    protected static function getClass(): string
    {
        return Prozedura::class;
    }
}
