<?php

interface PostBuilderInterface
{
    public function create(): Post;

    public function setTitle(string $value): self;

    public function setBody(string $value): self;

    public function setCategories(array $value): self;

    public function setTags(array $value): self;

    public function getPost(): Post;
}