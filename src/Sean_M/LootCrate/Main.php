<?php

namespace Sean_M\LootCrate;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\Player;

class Main extends PluginBase implements Listener {
    public $config;

     public function onEnable() {
        @mkdir($this->getDataFolder()); 
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->config = (new Config($this->getDataFolder(). "config.yml", Config::YAML, array(
        "time" => 10,
        "world-name" => "world",
        "broadcast.message" => "true",
        "message" => "Chest spawned at: {CHEST} !",
        "items" => array("276"))));
        $this->getLogger()->info(TextFormat::GREEN . "LootCrate by Sean_M enabled!");
           $time = $this->config->get("time");
           $this->getServer()->getScheduler()->scheduleRepeatingTask(new LootCrate($this), $time * 20);
     }

     public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "LootCrate by Sean_M disabled!");
     }
}  
