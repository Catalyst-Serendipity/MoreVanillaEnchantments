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

namespace serendipity\morevanillaenchantments;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\item\Food;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;
use serendipity\morevanillaenchantments\enchantment\ExtraVanillaEnchantments;

class EventListener implements Listener{

    public function onEntityDeath(EntityDeathEvent $event) : void{
        $victim = $event->getEntity();
        $cause = $victim->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent){
            $damager = $cause->getDamager();
            if($damager instanceof Player){
                $item = $damager->getInventory()->getItemInHand();
                foreach($item->getEnchantments() as $enchantmentInstance){
                    if($enchantmentInstance->getType() === ExtraVanillaEnchantments::LOOTING()){
                        $lootBonus = mt_rand(0, $enchantmentInstance->getLevel());
                        $drops = $event->getDrops();
                        // TODO: increase chance drop for Fox, Wither Skeletons
                        $guardianEntities = [EntityIds::GUARDIAN, EntityIds::ELDER_GUARDIAN];
                        if(in_array($victim::getNetworkTypeId(), $guardianEntities)){
                            $fish = [VanillaItems::CLOWNFISH(), VanillaItems::RAW_FISH(), VanillaItems::RAW_SALMON()];
                            $selectedFish = $fish[array_rand($fish)];
                            for($i = 0; $i < $lootBonus; $i++){
                                $drops[] = $selectedFish;
                            }
                        }
                        foreach($drops as $drop){
                            if($drop instanceof Food){
                                for($i = 0; $i < $lootBonus; $i++){
                                    $drops[] = $drop;
                                }
                                break;
                            }
                        }
                        $event->setDrops($drops);
                        break;
                    }
                }
            }
        }
    }
}