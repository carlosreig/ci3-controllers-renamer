# ci3-controllers-renamer
This application will search for files which filename starts with a lowercase character and are located in a folder called `controllers`. Then, if you provide the option, it will rename those files to start with an uppercase character.

## Setup

```
composer install
```

## Check files that will be renamed
```
./application.php controller:renamer:command  PATH_TO_CODEIGNITER_PROJECT
```

## Rename files
```
./application.php controller:renamer:command --rename-files PATH_TO_CODEIGNITER_PROJECT
```