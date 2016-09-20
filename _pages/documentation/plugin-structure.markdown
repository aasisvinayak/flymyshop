---
title: "Plugin Structure"
sidebar:
  nav: "docs"
layout: single
sitemap: true
share: true
permalink: /docs/plugin-structure/
---

When you create a plugin using the artisan command the following files are generated:

- config.php
- index.php
- install.php
- plugin.yml
- Name.php

# Name.php


This is the main class of the plugin and it extends `Plugin` interface. Here you will add the functions and hooks needed for the functioning of the plugin.

All plugins must have a <span style="color: red">`main()`</span> which is called when the plugin is first loaded.

If the plugin contains any hooks as methods, then it will stored in the HookContainer during load and the will be executed during the corresponding time.

# install.php

When the user installs the plugin, this file is executed. It should have a <span style="color: red">`database()`</span> method if it wants to run migrations to the application table.

# config.php

This is the view file the admin will see when the admin visits plugin config page. This must be written in blade.


# index.php

Any operations to be performed when the user updates the config file is done using this `index` file.

# plugin.yml

The information about the plugin is loaded from this file. This file should contain:

- plugin_name
- plugin_version
- author_name
- plugin_support_email
- plugin_description

It may also contain

- plugin_thumbnail_url
- plugin_website


