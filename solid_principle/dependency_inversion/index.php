<?php

class User {}

class UserController
{
    public function __construct(
        public readonly IUserService $userService)
    {}

    public function create(User $user): User
    {
        return $this->userService->create($user);
    }

    public function findById(string $id): User
    {
        return $this->userService->findById($id);
    }
}

interface IUserService
{
    public function create(User $user): User;

    public function findById(string $id): User;
}

class UserService implements IUserService
{
    public function __construct(
        public readonly IUserRepository $userRepository
    )
    {}

    public function create(User $user): User
    {
        return $this->userRepository->create($user);
    }

    public function findById(string $id): User
    {
        return $this->userRepository->findById($id);
    }
}

interface IUserRepository
{
    public function create(User $user): User;

    public function findById(string $id): User;
}

class UserRdbRepository implements IUserRepository
{
    public function create(User $user): User
    {
        print_r("RDBにUserを登録" . PHP_EOL);
        return $user;
    }

    public function findById(string $id): User
    {
        print_r("RdbID: {$id}のユーザーを検索" . PHP_EOL);
        return new User();
    }
}

class TestRepository implements IUserRepository
{
    public function create(User $user): User
    {
        print_r("RDBにUserを登録" . PHP_EOL);
        return $user;
    }

    public function findById(string $id): User
    {
        print_r("TestID: {$id}のユーザーを検索" . PHP_EOL);
        return new User();
    }
}


$userRdbRepository = new UserRdbRepository();
$testRepository = new TestRepository();
$userService = new UserService($userRdbRepository);
$userController = new UserController($userService);
$userController->findById("123");