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

class SmiteEnchantment extends MeleeWeaponEnchantment{

    private const UNDEAD_ENTITIES = [
        // TODO: Chicken Jockey 
        EntityIds::DROWNED,
        EntityIds::HUSK,
        EntityIds::PHANTOM,
        EntityIds::SKELETON,
        EntityIds::SKELETON_HORSE,
        // TODO: Skeleton Horseman
        // TODO: Spider Jockey
        EntityIds::STRAY,
        EntityIds::WITHER,
        EntityIds::WITHER_SKELETON,
        EntityIds::ZOGLIN,
        EntityIds::ZOMBIE,
        EntityIds::ZOMBIE_HORSE,
        EntityIds::ZOMBIE_PIGMAN,
        EntityIds::ZOMBIE_VILLAGER,
        EntityIds::ZOMBIE_VILLAGER_V2
    ];

    public function isApplicableTo(Entity $victim) : bool{
        if(in_array($victim::getNetworkTypeId(), self::UNDEAD_ENTITIES)){
            return true;
        }
        return false;
    }

    public function getDamageBonus(int $enchantmentLevel) : float{
        return $enchantmentLevel * 2.5;
    }

    public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
        if(!$this->isApplicableTo($victim)){
            return;
        }
    }
}