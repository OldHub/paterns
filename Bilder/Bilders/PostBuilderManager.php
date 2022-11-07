<?php

class PostBuilderManager
{
    private PostBuilderInterface $builder;

    public function setBuilder(PostBuilderInterface $builder): self
    {
        $this->builder = $builder;

        return $this;
    }

    public function createClearPost(): Post
    {
        return $this->builder->getPost();
    }

    public function createPostTags(): Post
    {
        return $this->builder
            ->setTitle('tags')
            ->setTags(['tag1', 'tag2'])
            ->getPost();
    }
}