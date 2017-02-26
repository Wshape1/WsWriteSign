<?php

namespace WsWriteSign;

use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\block\Block;
use pocketmine\tile\Sign;
use pocketmine\tile\Tile;

class WMain extends PluginBase implements Listener{
public $sign=array();
public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info(TF::GREEN."[WsWriteSign]插件已加载,作者Wshape1");
	}
	public function onCommand(CommandSender $sender, Command $command, $label , array $args){
	$name=$sender->getName();
	if(!$sender instanceof Player) return $sender->sendMessage("§8[§6WsWriteSign§8]§c请在游戏内使用");
	switch($command->getName()){
	case "wws":
	if(isset($args[0])){
	$this->sign[$name][0]=str_replace("@"," ",$args[0]);
	$this->sign[$name][1]=str_replace("@"," ",$args[1]);
	$this->sign[$name][2]=str_replace("@"," ",$args[2]);
	$this->sign[$name][3]=str_replace("@"," ",$args[3]);
	$this->sign[$name]["sign"]="sign";
	$sender->sendMessage("§8[§6WsWriteSign§8] §b请放置一个木牌");
	return true;
	}else{
	$sender->sendMessage("§8[§6WsWriteSign§8] §b/wws <第一行> <第二行> <第三行> <第四行> @是空格");
	return true;
	break;
	}
	}
	}
		public function SignWirte(SignChangeEvent $event){
		$player=$event->getPlayer();
		$name=$player->getName();
		switch($this->sign[$name]["sign"]){
		case "sign":
		$event->setLine(0,$this->sign[$name][0]);
		$event->setLine(1,$this->sign[$name][1]);
		$event->setLine(2,$this->sign[$name][2]);
		$event->setLine(3,$this->sign[$name][3]);
		$player->sendMessage("§8[§6WsWriteSign§8] 写入成功");
			$this->sign[$name][0]=null;
	$this->sign[$name][1]=null;
	$this->sign[$name][2]=null;
	$this->sign[$name][3]=null;
	$this->sign[$name]["sign"]=null;
	return true;
	break;
		}
	}
	}