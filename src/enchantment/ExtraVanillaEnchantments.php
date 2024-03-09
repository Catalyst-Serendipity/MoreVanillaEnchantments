<?php

/**
 * Copyright (c) 2024 Catalyst-Serendipity
 *      ______      __        __           __       _____                          ___       _ __       
 *     / ____/___ _/ /_____ _/ /_  _______/ /_     / ___/___  ________  ____  ____/ (_)___  (_) /___  __
 *    / /   / __ `/ __/ __ `/ / / / / ___/ __/_____\__ \/ _ \/ ___/ _ \/ __ \/ __  / / __ \/ / __/ / / /
 *   / /___/ /_/ / /_/ /_/ / / /_/ (__  ) /_/_____/__/ /  __/ /  /  __/ / / / /_/ / / /_/ / / /_/ /_/ / 
 *   \____/\__,_/\__/\__,_/_/\__, /____/\__/     /____/\___/_/   \___/_/ /_/\__,_/_/ .___/_/\__/\__, /  
 *                          /____/                                                /_/          /____/   
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  Catalyst Serendipity Team
 * @email   catalystserendipity@gmail.com
 * @link    https://github.com/Catalyst-Serendipity
 * 
 */

declare(strict_types=1);

namespace serendipity\morevanillaenchantments\enchantment;

use pocketmine\item\enchantment\Rarity;
use pocketmine\utils\RegistryTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static WaterEnchantment AQUA_AFFINITY()
 * @method static BaneOfArthropods BANE_OF_ARTHROPODS()
 */

final class ExtraVanillaEnchantments{
    use RegistryTrait;

    protected static function setup() : void{
        self::_registryRegister(
            "AQUA_AFFINITY", new WaterEnchantment(
                "Aqua Affinity",
                Rarity::COMMON,
                0,
                0,
                1,
                fn(int $level) : int => 0,
                0
        ));
        self::_registryRegister(
            "BANE_OF_ARTHROPODS", new BaneOfArthropods(
                "Bane of Arthropods",
                Rarity::RARE,
                0,
                0,
                5,
                fn(int $level) : int => 0,
                0
        ));
    }
}