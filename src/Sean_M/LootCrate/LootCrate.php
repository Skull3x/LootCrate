<?php

namespace Sean_M\LootCrate; //v2

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
       		$block = Block::get(Block::CHEST);
       		$level->setBlock($pos, $block);
       		$chest = $level->getTile($pos);
       		$slot = mt_rand(0,27);
       		foreach($this->config->get("items") as $item){
       		$chest->getInventory()->setItem($slot, $item);
       		$cx = $chest->getX();
       		$cy = $chest->getY();
       		$cz = $chest->getZ();
       		$cpos = new Vector3($cx, $cy, $cz);
       		if($this->config->get("broadcast.message") == "true"){
       			$this->getServer()->broadcastMessage($this->config->get("message", str_replace("{CHEST}", $cpos)));
       		}
       		}
	}
}
