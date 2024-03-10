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

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\AvailableEnchantmentRegistry;
use pocketmine\item\enchantment\ItemEnchantmentTags;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\plugin\PluginBase;
use ReflectionClass;
use serendipity\morevanillaenchantments\enchantment\ExtraVanillaEnchantments;
use serendipity\morevanillaenchantments\enchantment\handler\IncompatibleEnchantmentHandler;

class MoreVanillaEnchantments extends PluginBase{

    public const MORE_VANILLA_ENCHANTMENTS_LIST = [
        "Aqua Affinity",
        "Bane of Arthropods",
        "Channeling",
        "Cleaving",
        "Curse of Binding",
        "Curse of Vanishing",
        "Depth Strider",
        "Frost Walker",
        "Impaling",
        "Looting",
        "Loyalty",
        "Luck of the Sea",
        "Multishot",
        "Quick Charge",
        "Riptide",
        "Smite",
        "Soul Speed"
    ];

    protected function onLoad() : void{
        // Thanks DummyEnchantments by diamond-gold (ace)
        $data = [
            EnchantmentIds::AQUA_AFFINITY => [
                "name" => "Aqua Affinity",
                "instance" => ExtraVanillaEnchantments::AQUA_AFFINITY(),
                "primaryTags" => [
                    ItemEnchantmentTags::HELMET
                ],
                "secondaryTags" => []
            ],
            EnchantmentIds::BANE_OF_ARTHROPODS => [
                "name" => "Bane of Arthropods",
                "instance" => ExtraVanillaEnchantments::BANE_OF_ARTHROPODS(),
                "primaryTags" => [
                    ItemEnchantmentTags::SWORD,
                    ItemEnchantmentTags::AXE,
                ],
                "secondaryTags" => []
            ],
            EnchantmentIds::DEPTH_STRIDER => [
                "name" => "Depth Strider",
                "instance" => ExtraVanillaEnchantments::DEPTH_STRIDER(),
                "primaryTags" => [
                    ItemEnchantmentTags::BOOTS
                ],
                "secondaryTags" => []
            ],
            EnchantmentIds::FROST_WALKER => [
                "name" => "Frost Walker",
                "instance" => ExtraVanillaEnchantments::FROST_WALKER(),
                "primaryTags" => [],
                "secondaryTags" => [
                    ItemEnchantmentTags::BOOTS
                ]
            ],
            EnchantmentIds::LOOTING => [
                "name" => "Looting",
                "instance" => ExtraVanillaEnchantments::LOOTING(),
                "primaryTags" => [
                    ItemEnchantmentTags::SWORD
                ],
                "secondaryTags" => []
            ],
            EnchantmentIds::SMITE => [
                "name" => "Smite",
                "instance" => ExtraVanillaEnchantments::SMITE(),
                "primaryTags" => [
                    ItemEnchantmentTags::SWORD,
                    ItemEnchantmentTags::AXE,
                ],
                "secondaryTags" => []
            ]
        ];
        $reflectionClass = new ReflectionClass(EnchantmentIds::class);
        foreach($reflectionClass->getConstants() as $name => $id){
            if(EnchantmentIdMap::getInstance()->fromId($id) === null){
                if(!isset($data[$id])) {
                    $this->getLogger()->debug("Enchantment $name is not supported yet");
                    continue;
                }
                EnchantmentIdMap::getInstance()->register($id, $data[$id]["instance"]);
                AvailableEnchantmentRegistry::getInstance()->register(
                    $data[$id]["instance"],
                    $data[$id]["primaryTags"] ?? [],
                    $data[$id]["secondaryTags"] ?? []
                );
                StringToEnchantmentParser::getInstance()->register($data[$id]["name"], fn() => $data[$id]["instance"]);
            }
        }

        IncompatibleEnchantmentHandler::register();
    }

    protected function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}