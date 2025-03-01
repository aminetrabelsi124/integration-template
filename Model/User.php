<?php
class User {
    public int $id;
    private string $email;
    private string $pwd;
    public function __construct($email=null, $pwd=null)
    {
        $this->email= $email;
        $this->pwd= $pwd;
    }
    public function getEmail()
    {
        return $this->email;
    }
    @return  self
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    @return int
    public function getId(): int
    {
        return $this->id;
    }
    @param int $id
    @return self
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    @return string
    public function getPwd(): string
    {
        return $this->pwd;
    }
    @param string $pwd
    @return self
    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;
        return $this;
    }
}
?>