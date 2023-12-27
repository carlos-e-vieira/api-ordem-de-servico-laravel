<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function testFileAndPathOfUserService(): void
    {
        $directory = 'app/services';
        $filePath = 'app/services/UserService.php';

        $this->assertDirectoryExists($directory);
        $this->assertFileExists($filePath);
    }

    public function testGetAllUsers(): void
    {
        $userService = resolve(UserService::class);

        $filters = [];
        $result = $userService->getAllUsers($filters);

        $this->assertNotEmpty($result);
        $this->assertIsNotArray($result);
        $this->assertIsObject($result);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }
}
