---
title: "Structure of the application"
sidebar:
  nav: "docs"
layout: single
excerpt: "Directory structure of FlyMyShop"
sitemap: true
share: true
permalink: /docs/structure/
---

FlyMyShop code is organised into two main directories:

1. core
2. public

# core
Everything related to teh core application that does not need to be available to the public
are located in the 'core' folder. Core folder has the following directories

1. app

Same as in Laravel except in the presence of the Flymyshop class which sets up the directory structure.
It is an extension of Laravel Application class and it simply tells the server where the files are.

You will able to find all Controllers, Models, Events, Jobs, Policies, Routes etc under this directory.

2. bootstrap

Same as in Laravel

3. config

Same as in Laravel

4. database

Same as in Laravel

5. docker

All the docker related files except the main Dokerfile is placed here.

6. flymyshop

Anything that offers modularity to FlyMyShop application is found under this. Please see the section below for details.

7.resources

All non-public resources are located here. This includes assets for compiling, admin theme and installation theme.

8. storage

Same as in Laravel

9. tests

Same as in Laravel


## flymyshop

Under this you will be able to find:

1. Containers

DataContainer.php
HookContainer.php
ProductContainer.php

2. Core

EnablePlugins.php
EnableRequestPlugins.php
EnableResponsePlugins.php
3. Helpers
PluginHelper.php
4. Plugins
5. functions.php
6. hooks.php
7. stubs

# public

themes

uploads/assets

