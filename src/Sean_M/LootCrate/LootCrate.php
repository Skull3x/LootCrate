<?php

namespace Sean_M\LootCrate;

use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\inventory\Inventory;
use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\block\Chest;
use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use Sean_M\LootCrate\Main;


class LootCrate extends PluginTask{
	public $player;
	public function __construct(Main $owner){
		parent::__construct($owner);
		$this->config = $owner->config;
	}

    public function onRun($currentTick) {
       $level = $this->config->get("world-name");
       $x = mt_rand(0,255);
       $y = mt_rand(0,255);
       $z = mt_rand(0,255);
       $pos = new Vector3($x, $y, $z);
       $level->setBlock($pos, Block::get(54,0));
       $chest = $level->getTile($pos);
       $slot = mt_rand(0,27);
       foreach($this->config->get("items") as $item){
       $chest->getInventory()->setItem($slot, $item);
       }
   /*todo $plugin->getServer()->broadcastMessage("Chest spawned at: ") */
}
}
