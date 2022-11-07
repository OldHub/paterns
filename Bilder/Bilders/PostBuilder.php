
<?php

class PostBuilder implements PostBuilderInterface
{
    private Post $post;

    public function __construct()
    {
        $this->create();
    }

    public function create(): Post
    {
        return new Post();
    }

    public function setTitle(string $value): self
    {
        $this->post->title = $value;

        return $this;
    }

    public function setBody(string $value): self
    {
        $this->post->body = $value;

        return $this;
    }

    public function setCategories(array $value): self
    {
        $this->post->categories = $value;

        return $this;
    }

    public function setTags(array $value): self
    {
        $this->post->tags = $value;

        return $this;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}