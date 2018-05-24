# WEB-MANAGEMENT-SPORT-TEAM

# Table of content
* [Installation and Configuration](#installation-and-configuration)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
  * [Adding Player to Team](#adding-player-to-team)
  * [Create Team](#create-team)
  * [Create Game](#create-game)
  * [Mail System](#mail-system)
  * [Profile Update](#profile-update)
  * [Promote](#promote)
  * [Stats update](#stats-update)
* [Technology Used](#technology-used)
* [Acknowledgements](#acknowledgements)
* [Authors/Contributors](#authorscontributors)

# Summary
- In this project, my teammates and I used PHP and mySQL to design a web application where users can create their own tournamanents. There are four different types of user that are admin, manager, player, and normal user. Each type of user has different priviledges and functionality in the application.
- Our website provides the functionality to completely manage a basketball league
- Using our website, you can keep track of all:
  + Teams
  + Players
  + Games
  + Statistics

# Installation and Configuration
## Prerequisites

You will need the following things properly installed on your computer.
* [Git](https://git-scm.com/)
* [PHP](http://php.net/downloads.php)
* [XAMPP](https://www.apachefriends.org/download.html)
* [Google Chrome](https://www.google.com/intl/en_ca/chrome/)

## Installation
* `git clone https://github.com/tngo0508/CPSC431-final-project/`
* `Follow this`[README](https://github.com/tngo0508/CPSC431-final-project/blob/master/SOURCE%20CODE/INSTALL%20PHPMAILER/readme%20install%20email%20forgotpassword.txt) to install PHPMailer
* `Run XAMPP - Apache, PHP`
* `Go to folder htdocs in XAMPP and put all files into there`
* `Visit Link: http://localhost/phpmyadmin to import SPORT-MANAGEMENT_ddl.sql` 
* `Visit http://localhost/SOURCE CODE`


# Usage
### ADDING PLAYER TO TEAM

![A1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/ADDING%20PLAYER%20TO%20TEAM/add%20player%20to%20the%20game%20with%20stats%20NULL.PNG?raw=true)
![A2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/ADDING%20PLAYER%20TO%20TEAM/added%20a%20player%20name%20p10.PNG?raw=true)
![A3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/ADDING%20PLAYER%20TO%20TEAM/game%20already%20assigned%20by%20admin%20(%20player%20listed%20on%20add%20and%20remove%20table).PNG?raw=true)
![A4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/ADDING%20PLAYER%20TO%20TEAM/manager%20interface%20for%20adding%20player.PNG?raw=true)

### CREATE TEAM

![B1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20A%20TEAM/MAKING%20A%20TEAM.PNG)
![B2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20A%20TEAM/MANAGER%20AVALIABLE%20TO%20LEAD%20A%20TEAM.PNG)
![B3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20A%20TEAM/PROMOTE%20TO%20BE%20MANAGER.PNG)
![B4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20A%20TEAM/result%20after%20making%20a%20team.PNG)

### CREATE GAME

![C1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/ASSIGNING%201%20GAME%20WITH%202%20TEAM.PNG)
![C2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/CREATE%20GAME%20INTERFACE.PNG)
![C3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/GAME%20NOW%20AVALIABLE.PNG)
![C4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/RESULT%20AFTER%20UPDATE%20SCORE%20FOR%20GAME%20ID%206.PNG)
![C5](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/RESULT%20GAME%20ID%206%20WITH%20TWOS%20TEAM.PNG)
![C6](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/CREATE%20GAME%20FUNCTION/UPDATE%20SCORE%20FOR%20GAME%206%20WITH%20TEAM%20ID%201.PNG)

### MAIL SYSTEM
![D1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/MAIL%20SYSTEM/READING%20MAIL%20BY%20IMAP/imap.PNG)
![D2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/MAIL%20SYSTEM/READING%20MAIL%20BY%20IMAP/reading%20mail.PNG)
![D3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/MAIL%20SYSTEM/SENT%20MAIL%20VIA%20PHPMAILER/php%20mailer.PNG)
![D4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/MAIL%20SYSTEM/SENT%20MAIL%20VIA%20PHPMAILER/sending%20mail.PNG)

### PROFILE UPDATE
![E1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROFILE%20UPDATE/empty%20profile.PNG)
![E2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROFILE%20UPDATE/result%20after%20update.PNG)
![E3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROFILE%20UPDATE/update%20profile.PNG)

### PROMOTE
![F1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROMOTE/admin%20interface%20page.PNG)
![F2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROMOTE/promote%20an%20account.PNG)
![F3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROMOTE/promote%20to%20be%20player.PNG)
![F4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROMOTE/result%20after%20promote.PNG)
![F5](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/PROMOTE/roles%20base.PNG)

### STATS UPDATE
![G1](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/Stats%20update/result%20after%20update.PNG)
![G2](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/Stats%20update/stats%20table.PNG)
![G3](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/Stats%20update/update%20form%20for%20stats.PNG)
![G4](https://github.com/tngo0508/CPSC431-final-project/blob/master/SCREEN%20SHOT%20VIEWS/Stats%20update/update%20stats%20for%20player.PNG)

# Technology Used

Programming Languages
+ HTML5
+ Javascript
+ CSS3
+ PHP

Front-End
+ Bootstrap 4.0

Database 
+ MySQL

Text Editor
+ Atom
+ Vim

Third-party library
+ PHPMailer

# Acknowledgements

-   **Professor Thomas Bettens** - _tbettens@fullerton.edu_ - California State University, Fullerton

## Authors/Contributors

-   **Thomas Ngo** - _tngo0508@csu.fullerton.edu_ - [tngo0508](https://github.com/tngo0508)
-   **Danh Pham** - _danhpham312@gmail.com_ - .[Dpham181](https://github.com/Dpham181)

