<?php

namespace App\Tests;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskEntityTest extends TestCase
{
    public function testTrue()
    {
        $user = new User();
        $datetime = new \DateTime();
        $task = new Task;

        $task->setTitle('title');
        $task->setCreatedAt($datetime);
        $task->setContent('content');
        $task->setIsDone(false);
        $task->setAuthor($user);

        $this->assertTrue($task->getTitle() === 'title');
        $this->assertTrue($task->getCreatedAt() === $datetime);
        $this->assertTrue($task->getContent() === 'content');
        $this->assertTrue($task->getIsDone() === false);
        $this->assertTrue($task->getAuthor() === $user);
    }

    public function testFalse()
    {
        $user = new User();
        $datetime = new \DateTime();
        $task = new Task;

        $task->setTitle('title');
        $task->setCreatedAt($datetime);
        $task->setContent('content');
        $task->setIsDone(false);
        $task->setAuthor($user);

        $this->assertFalse($task->getTitle() === 'false');
        $this->assertFalse($task->getCreatedAt() === new \DateTime());
        $this->assertFalse($task->getContent() === 'false');
        $this->assertFalse($task->getIsDone() === true);
        $this->assertFalse($task->getAuthor() === new User());
    }

    public function testEmpty()
    {
        $task = new Task;
        $task->setCreatedAt(null);
        $task->toggle(null);

        $this->assertEmpty($task->getTitle());
        $this->assertEmpty($task->getCreatedAt());
        $this->assertEmpty($task->getContent());
        $this->assertEmpty($task->isDone());
        $this->assertEmpty($task->getAuthor());
        $this->assertEmpty($task->getId());
    }
}
