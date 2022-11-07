<?php

class FileManager
{
    public function someFileWork($file)
    {
        $fileManager = app(Adapter::class);

        $fileManager->save($file);

        $fileManager->getName($file);
    }
}