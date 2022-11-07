<?php

class PostController
{
    public function Builder()
    {
        $builder = app(PostBuilder::class);

        $posts[] = $builder->setTitle('123')->getPost();


        $manager = app(PostBuilderManager::class);
        $manager->setBuilder($builder);

        $posts[] = $manager->createClearPost();
        $posts[] = $manager->createPostTags();
    }
}