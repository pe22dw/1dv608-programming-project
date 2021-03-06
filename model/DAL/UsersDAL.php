<?php

class UsersDAL {
    
     /*
        Handles logic regarding storage of users and exercises.
    */
    
    private $storageFile;
    
    public function __construct() {
        $dir = dirname(__FILE__);
        $this->storageFile = $dir . '/storagefiles/users.txt';
    }
    
    //Gets all the users from file.
    public function getUsersFromFile() {
        if(file_exists($this->storageFile)) {
            if(filesize($this->storageFile) > 0) {
                $contents = file_get_contents($this->storageFile);
                return unserialize($contents);
            }
        }
        return null;
    }
    
    //Gets a user's all exercises from file.
    public function getExercisesFromFile($file) {
        if(file_exists($file)) {
            if(filesize($file) > 0) {
                $contents = file_get_contents($file);
                return unserialize($contents);
            }
        }
        return null;
    }
    
    //Saves all the users to file.
    public function saveUsersToFile($users) {
        $contents = serialize($users);
        if(!file_put_contents($this->storageFile, $contents)) {
            throw new Exception();
        }
    }
    
    //Saves a user's all exercises to file.
    public function saveExercisesToFile($exercises, $file) {
        $contents = serialize($exercises);
        if(!file_put_contents($file, $contents)) {
            throw new Exception();
        }
    }
}