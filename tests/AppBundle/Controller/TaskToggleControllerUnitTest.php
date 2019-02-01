<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 01/02/2019
 * Time: 18:34
 */

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\TaskToggleController;
use AppBundle\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class TaskToggleControllerUnitTest
 * @package Tests\AppBundle\Controller
 */
class TaskToggleControllerUnitTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testToggleTaskResponse()
    {

        $task = $this->createMock(Task::class);

        $repository = $this->createMock(TaskRepository::class);

        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->method('generate')->willReturn('task_list');

        $addFlash = $this->createMock(FlashBagInterface::class);
        $addFlash->method('add')->willReturn('test');

        $messageFlash = $this->createMock(Session::class);
        $messageFlash->method('getFlashBag')->willReturn($addFlash);

        $taskToggleController = new TaskToggleController();

        $this->assertInstanceOf(RedirectResponse::class,
            $taskToggleController->toggleTask($task, $repository, $urlGenerator, $messageFlash));
    }

    /**
     * @throws \Exception
     */
    public function testToggleTaskRedirect()
    {
        $task = $this->createMock(Task::class);

        $repository = $this->createMock(TaskRepository::class);

        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->method('generate')->willReturn('task_list');

        $addFlash = $this->createMock(FlashBagInterface::class);
        $addFlash->method('add')->willReturn('test');

        $messageFlash = $this->createMock(Session::class);
        $messageFlash->method('getFlashBag')->willReturn($addFlash);

        $taskToggleController = new TaskToggleController();

        $this->assertInstanceOf(RedirectResponse::class,
            $taskToggleController->toggleTask($task, $repository, $urlGenerator, $messageFlash));
    }
}