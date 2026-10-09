<?php

declare(strict_types=1);

namespace NhanAZ\WorldsLoader;

use pocketmine\plugin\PluginBase;
use pocketmine\world\WorldException;

class Main extends PluginBase {

	protected function onEnable(): void {
		$worldsPath = $this->getServer()->getDataPath() . "worlds" . DIRECTORY_SEPARATOR;
		$worlds = scandir($worldsPath);
		if ($worlds === false) {
			$this->getLogger()->error("Cannot read the worlds directory");
			return;
		}

		$worldManager = $this->getServer()->getWorldManager();
		$loadedWorlds = [];
		foreach ($worlds as $worldName) {
			if ($worldName === "." || $worldName === ".." || !is_dir($worldsPath . $worldName) || $worldManager->isWorldLoaded($worldName)) {
				continue;
			}
			try {
				if ($worldManager->loadWorld($worldName, true)) {
					$loadedWorlds[] = $worldName;
				} else {
					$this->getLogger()->warning("Could not load world " . $worldName);
				}
			} catch (WorldException $error) {
				$this->getLogger()->error("Could not load world " . $worldName . ": " . $error->getMessage());
			}
		}
		$this->getLogger()->info("Additional worlds loaded: [" . implode(", ", $loadedWorlds) . "]");
	}
}
