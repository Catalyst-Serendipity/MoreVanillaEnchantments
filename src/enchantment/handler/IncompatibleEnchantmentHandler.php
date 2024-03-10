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

namespace serendipity\morevanillaenchantments\enchantment\handler;

use pocketmine\item\enchantment\IncompatibleEnchantmentRegistry;
use pocketmine\item\enchantment\VanillaEnchantments;
use serendipity\morevanillaenchantments\enchantment\ExtraVanillaEnchantments;

class IncompatibleEnchantmentHandler{

    public const BANE_OF_ARTHROPODS = "bane_of_arthropods";
    public const DEPTH_STRIDER = "depth_strider";
    public const FROST_WALKER = "frost_walker";
    public const SMITE = "smite";

    private function __construct(){}

    public static function register() : void{
        $registry = IncompatibleEnchantmentRegistry::getInstance();
        $registry->register(self::BANE_OF_ARTHROPODS, [ExtraVanillaEnchantments::BANE_OF_ARTHROPODS(), ExtraVanillaEnchantments::SMITE(), VanillaEnchantments::SHARPNESS()]);
        $registry->register(self::DEPTH_STRIDER, [ExtraVanillaEnchantments::DEPTH_STRIDER(), ExtraVanillaEnchantments::FROST_WALKER()]);
        $registry->register(self::FROST_WALKER, [ExtraVanillaEnchantments::FROST_WALKER(), ExtraVanillaEnchantments::DEPTH_STRIDER()]);
        $registry->register(self::SMITE, [ExtraVanillaEnchantments::SMITE(), ExtraVanillaEnchantments::BANE_OF_ARTHROPODS(), VanillaEnchantments::SHARPNESS()]);
    }
}