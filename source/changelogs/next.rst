Version |version|
====================================================

Release Date: Not released

**Next alpha release of CodeIgniter4**

- updated PHP dependency to 7.2
- new feature branches have been created for the email and queue modules, so they don't impact the release of 4.0.0
- dropped several language messages that were unused (eg Migrations.missingTable) and added some new (eg Migrations.invalidType)
- lots of bug fixes
- code coverage is up to 78%

The list of changed files follows, with PR numbers shown.

- admin/
	- starter/README.md #1637
- app/
	- Config/
		- Modules #1665
		- Services #614216

- contributing/
	- guidelines.rst #1671, #1673
	- internals.rst #1671

- public/
	- index.php #1648, #1670

- system/
	- Autoloader/
		- Autoloader #1665, #1672
		- FileLocator #1665
	- Config/
		- BaseConfig #1635
		- BaseService #1635, #1665
		- Paths #1626
		- Services #614216, #3a4ade, #1643
		- View #1616
	- Database/
		- BaseBuilder #1640, #1663
		- Config #6b8b8b, #1660
		- MigrationRunner #81d371, #1660
	- Debug/Toolbar/Collectors/
		- Logs #1654
		- Views #3a4ade
	- Events/
		- Events #1635
	- Exceptions/
		- ConfigException #1660
	- Files/
		- Exceptions/FileException #1636
		- File #1636
	- Filters/
		- Filters #1635, #1625, #6dab8f
	- Helpers/
		- form_helper #1633
		- html_helper #1538
		- xml_helper #1641
	- HTTP/
		- ContentSecurityPolicy #1641, #1642
	- Language/
		- /en/Files #1636
		- Language #1641
	- Log/
		- Handlers/FileHandler #1641
	- Router/
		- RouteCollection #1665
		- Router #9e435c, #7993a7
	- bootstrap #81d371, #1665
	- Common #1660
	- Entity #1623, #1622
	- Model #1617, #1632, #1656

- tests/
	- README.md #1671

- tests/system/
	- API/
		- ResponseTraitTest #1635
	- Autoloader/
		- AutoloaderTest #1665
		- FileLocatorTest #1665
	- CLI/
		- CommandRunnerTest #1635
		- CommandsTest #1635
	- Config/
		- BaseConfigTest #1635
		- ConfigTest #1643
		- ServicesTest #1635, #1643
	- Database/Builder/
		- GroupTest #1640
		- InsertTest #1640
 		- LikeTest #1640
		- SelectTest #1663
		- UpdateTest #1640
		- WhereTest #1640
	- Database/Live/
		- ConnectTest #1660
		- ForgeTest #6b8b8b
		- Migrations/MigrationRunnerTest #1660
		- ModelTest #1617
	- Events/
		- EventTest #1635
	- Filters/
		- FiltersTest #1635, #6dab8f
	- Helpers/
		- FormHelperTest #1633
		- XMLHelperTest #1641
	- HTTP/
		- ContentSecurityPolicyTest #1641
		- IncomingRequestTest #1641
	- Language/
		- LanguageTest #1643
	- Router/
		- RouterTest #9e435c
	- View/
		- ParserPluginTest #1669
		- ParserTest #1669

- user_guide_src/
	
	- concepts/
		- autoloader #1665
		- structure #1648
	- database/
		- connecting #1660
		- transactions #1645
	- general/
		- configuration #1643
		- managing_apps #5f305a, #1648
		- modules #1613, #1665
	- helpers/
		- form_helper #1633
	- installation/
		- downloads.rst #1673
		- installation #1673
	- libraries/
		- index #1643

- composer.json #1670
- contributing.md #1670
- README.md #1670
- spark #1648
- .travis.yml #1649, #1670

PRs merged:
-----------

- #1673 Updated download & installation docs
- #1672 Update Autoloader.php
- #1670 Update PHP dependency to 7.2
- #1671 Update docs
- #1669 Enhance Parser & Plugin testing
- #1665 Composer PSR4 namespaces are now part of the modules auto-discovery
- #6dab8f Filters match case-insensitively
- #1663 Fix bind issue that occurred when using whereIn
- #1660 Migrations Tests and database tweaks
- #1656 DBGroup in __get(), allows to validate "database" data outside the model
- #1654 Toolbar - Return Logger::$logCache items
- #1649 remove php 7.3 from "allow_failures" in travis config
- #1648 Update "managing apps" docs
- #1645 Fix transaction enabling confusing (docu)
- #1643 Remove email module
- #1642 CSP nonce attribute value in ""
- #81d371 Safety checks for config files during autoload and migrations
- #1641 More unit testing tweaks
- #1640 Update getCompiledX methods in BaseBuilder 
- #1637 Fix starter README
- #1636 Refactor Files module
- #5f305a UG - Typo in managing apps
- #1635 Unit testing enhancements
- #1633 Uses csrf_field and form_hidden
- #1632 DBGroup should be passed to ->run instead of ->setRules
- #1631 move use statement after License doc at UploadedFile class
- #1630 Update copyright to 2019
- #1629 "application" to "app" directory doc and comments
- #3a4ade view() now properly reads the app config again
- #7993a7 Final piece to get translateURIDashes working appropriately
- #9e435c TranslateURIDashes fix
- #1626 clean up Paths::$viewDirectory property
- #1625 After matches is not set empty
- #1623 Property was not cast if was defined as nullable
- #1622 Nullable support for __set
- #1617 countAllResults() should respect soft deletes
- #1616 Fix View config merge order
- #614216 Moved honeypot service out of the app Services file to the system Services where it belongs
- #6b8b8b Allow db forge and utils to take an array of connection info instead of a group name
- #1613 Typo in documentation
- #1538 img fix(?) - html_helper
