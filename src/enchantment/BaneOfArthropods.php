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

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class BaneOfArthropods extends MeleeWeaponEnchantment{

    private const ARTHROPODS_ENTITIES = [
        EntityIds::BEE,
        EntityIds::CAVE_SPIDER,
        EntityIds::ENDERMITE,
        EntityIds::SILVERFISH,
        EntityIds::SPIDER
    ];

    public function isApplicableTo(Entity $victim) : bool{
        if(in_array($victim::getNetworkTypeId(), self::ARTHROPODS_ENTITIES)){
            return true;
        }
        return false;
    }

    public function getDamageBonus(int $enchantmentLevel) : float{
        return $enchantmentLevel * 2.5;
    }

    public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
        $effectDuration = (mt_rand(10, (10 + (5 * $enchantmentLevel))) / 10);
        if($victim instanceof Living && $this->isApplicableTo($victim)){
            $victim->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), ($effectDuration * 20), 4));
        }
    }
}