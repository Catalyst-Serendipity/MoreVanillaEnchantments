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

use pocketmine\entity\Entity;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class LootingEnchantment extends MeleeWeaponEnchantment{

    private const NOT_AFFECTED_ENTITIES = [
        EntityIds::BAT,
        EntityIds::BEE,
        EntityIds::CAT,
        EntityIds::COD,
        EntityIds::ENDERMITE,
        EntityIds::IRON_GOLEM,
        // TODO: panda ??
        EntityIds::PUFFERFISH,
        EntityIds::SALMON,
        EntityIds::SNOW_GOLEM,
        EntityIds::TROPICALFISH,
        EntityIds::WITHER
    ];

    public function isApplicableTo(Entity $victim) : bool{
        if(in_array($victim::getNetworkTypeId(), self::NOT_AFFECTED_ENTITIES)){
            return false;
        }
        return true;
    }

    public function getDamageBonus(int $enchantmentLevel) : float{
        return 0;
    }

    public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
        if(!$this->isApplicableTo($victim)){
            return;
        }
    }
}