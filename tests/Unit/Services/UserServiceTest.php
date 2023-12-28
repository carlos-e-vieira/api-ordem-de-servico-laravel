<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private function getInstance(): UserService
    {
        return resolve(UserService::class);
    }

    public function testFileAndPathOfUserService(): void
    {
        $directory = 'app/services';
        $filePath = 'app/services/UserService.php';

        $this->assertDirectoryExists($directory);
        $this->assertFileExists($filePath);
    }

    public function testGetAllUsers(): void
    {

        $filters = [];
        $result = $this->getInstance()->getAllUsers($filters);

        $this->assertNotEmpty($result);
        $this->assertIsNotArray($result);
        $this->assertIsObject($result);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    
    public function testGetUserById(): void
    {
        $result = $this->getInstance()->getUserById(1);

        $this->assertInstanceOf(UserResource::class, $result);
        $this->assertNotEmpty($result);
    }
}
