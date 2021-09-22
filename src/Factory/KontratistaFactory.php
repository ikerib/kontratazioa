<?php

namespace App\Factory;

use App\Entity\Kontratista;
use App\Repository\KontratistaRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Kontratista>
 *
 * @method static Kontratista|Proxy createOne(array $attributes = [])
 * @method static Kontratista[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Kontratista|Proxy find(object|array|mixed $criteria)
 * @method static Kontratista|Proxy findOrCreate(array $attributes)
 * @method static Kontratista|Proxy first(string $sortedField = 'id')
 * @method static Kontratista|Proxy last(string $sortedField = 'id')
 * @method static Kontratista|Proxy random(array $attributes = [])
 * @method static Kontratista|Proxy randomOrCreate(array $attributes = [])
 * @method static Kontratista[]|Proxy[] all()
 * @method static Kontratista[]|Proxy[] findBy(array $attributes)
 * @method static Kontratista[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Kontratista[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static KontratistaRepository|RepositoryProxy repository()
 * @method Kontratista|Proxy create(array|callable $attributes = [])
 */
final class KontratistaFactory extends ModelFactory
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
            //'izena_eus' => self::faker()->realText(60),
            'izena_eus' => self::faker()->company()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Kontratista $kontratista) {})
        ;
    }

    protected static function getClass(): string
    {
        return Kontratista::class;
    }
}
