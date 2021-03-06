<?php

declare(strict_types=1);
namespace Fury\Filesystem\Tests;

use Fury\Filesystem\File;
use Fury\Filesystem\NotAFileException;
use Fury\Filesystem\Path;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testWorksOnExistingFile()
    {
        $file = new File(new Path(__DIR__ . '/fixtures/some-dir/some-file.txt'));
        $this->assertTrue($file->exists());
    }

    public function testWorksOnSymlinkedFile()
    {
        $file = new File(new Path(__DIR__ . '/fixtures/some-dir/some-other-file.txt'));
        $this->assertTrue($file->exists());
    }

    public function testThrowsExceptionIfPathIsASymlinkedDirectory()
    {
        $this->expectException(NotAFileException::class);
        new File(new Path(__DIR__ . '/fixtures/some-dir/some-other-dir'));
    }
}
