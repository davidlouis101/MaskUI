<?php

namespace MaskUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\Config;
use MaskUI\Main;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("§7[§eMaskUI§7] §aEnable Plugin...");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§7[§eMaskUI§7] §cPlease install FormAPI Plugin, §4disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "maske":
        if(!($sender instanceof Player)){
                $sender->sendMessage($this->getConfig()->get("console-msg"));
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->sendMessage($this->getConfig()->get("quit-msg"));
                        break;
                    case 1:
                    $sender->sendMessage("§eMaskUI§7>> §aDeine Maske Wurde Geandert auf §fSkeleton!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 0, 1));
	                $sender->addTitle("§6Du Bekommst", "§fSkeleton §eMaske");
						break;
					case 2:
					$sender->sendMessage("§eMaskUI§7>> §aDeine Maske Wurde Geandert auf §0Wither Skeleton!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 1, 1));
	                $sender->addTitle("§6Du Bekommst", "§0Wither Skeleton §eMask");
						break;
					case 3:
					$sender->sendMessage("§eMaskUI§7>> §aDeine Maske Wurde Geandert auf §2Zombie!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 2, 1));
	                $sender->addTitle("§6Du Bekommst", "§2Zombie §eMaske");
					    break;
					case 4:
					$sender->sendMessage("§eMaskUI§7>> §aDeine Maske Wurde Geandert auf Creeper!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 4, 1));
	                $sender->addTitle("§6Du Bekommst", "§aCreeper §eMaske");
					    break;
					case 5:
					$sender->sendMessage("§eMaskUI§7>> §6Deine Maske Wurde Geandert auf §4Drache!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getArmorInventory()->setHelmet(Item::get(397, 5, 1));
	                $sender->addTitle("§6Du Bekommst", "§4Dragon §eMask");
					    break;
            }
        });
        $form->setTitle("§l§eMask §fMenu");
        $form->setContent("§7Bitte Wahle Eine Maske");
        $form->addButton("§l§bExit", 0);
        $form->addButton("§l§fSkeleton", 1);
        $form->addButton("§l§0Wither Skeleton", 2);
        $form->addButton("§l§2Zombie", 3);
        $form->addButton("§l§aCreeper", 4);
        $form->addButton("§l§4Dragon", 5);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("- [MaskUI] Disabled Plugin!");
    }
}

