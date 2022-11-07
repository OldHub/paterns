<?php

class Adapter
{
    public function __construct(private NewPackage $adapter) { }

    public function save($file)
    {
        $this->adapter->upload($file);
    }

    public function delete($file)
    {
        $this->adapter->destroy($file);
    }

    public function getFile($file)
    {
        $this->adapter->takeFile($file);
    }

    public function getName($file)
    {
        $this->adapter->takeName($file);
    }
}