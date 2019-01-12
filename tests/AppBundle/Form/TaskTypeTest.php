<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 13:40
 */

namespace Tests\AppBundle\Form;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\Form\Test\TypeTestCase;

class TaskTypeTest extends TypeTestCase
{

    public function testForm()
    {
        $formData = [
            'title' => 'test',
            'content' => 'test'
        ];

        $taskToCompare = $this->createMock(Task::class);

        $form = $this->factory->create(TaskType::class, $taskToCompare);

        $task = $this->createMock(Task::class);
        $task->setTitle('test');
        $task->setContent('test');

        $form->submit($formData);

        $this->assertTrue($form->isValid());

        $this->assertEquals($task, $taskToCompare);

        $this->assertInstanceOf(Task::class, $form->getData());
    }
}