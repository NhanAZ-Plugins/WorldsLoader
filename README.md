# WorldsLoader

WorldsLoader loads existing server worlds when the plugin starts. It skips the default world and any other world that is already loaded.

## Compatibility

The plugin declares Axolotl-PM API `5.0.0` and requires the PHP version supported by that server. The [build workflow](.github/workflows/build.yml) pins a server source revision for PHPStan at level max and a [DevTools](https://github.com/NhanAZ/DevTools) release for the PHAR build. A successful test on one stable server release does not establish compatibility with every 5.x release.

## Installation and behavior

Place the released WorldsLoader PHAR in the server's `plugins` directory and restart the server. It reads subdirectories of the server's `worlds` directory and asks Axolotl-PM to load each world that is not already loaded. Unknown or corrupted formats are reported and do not stop attempts to load other worlds.

When a supported read-only world format requires conversion, WorldsLoader delegates the conversion to Axolotl-PM's world manager. The server places a backup of the original world under its `backups/worlds` directory. Keep a separate backup before changing world formats, especially on a production server. WorldsLoader does not create new worlds or add commands or permissions.

## Build and verification

The [build workflow](.github/workflows/build.yml) runs PHPStan at level max, lints the source, builds a PHAR with DevTools and checks the artifact contents and checksum. The pinned server and builder revisions are in the workflow and its run history. The release artifact is published from a verified CI run.

## Support and license

Report issues at [GitHub Issues](https://github.com/NhanAZ-Plugins/WorldsLoader/issues). The original project license text is retained in [LICENSE](LICENSE), under GPL-3.0. The original author attribution remains in `plugin.yml`.
