<?php

declare(strict_types=1);

namespace App\Tests\Common\Domain\Util;

use App\Common\Domain\Router\RouterInterface;
use App\Common\Domain\Util\Paginator;
use App\Common\Infrastructure\Router\Router;
use App\Tests\TestBase;
use AssertionError;

class PaginatorTest extends TestBase
{
    public function testSetTotalRecords(): void
    {
        $router = $this->getMockBuilder(RouterInterface::class)->getMock();

        foreach (
            [
                [30, 3],
                [26, 2],
                [13, 1],
                [0, 0],
                [-1, 0],
            ] as $case
        ) {
            [$totalRecords, $expected] = $case;

            $paginator = new Paginator(
                $router,
                'test_route',
                ['testRouteParam' => 'testRouteParamValue'],
                5,
                13,
                'customPage',
            );

            $this->assertEquals($expected, $paginator->setTotalRecords($totalRecords)->getTotalPages());
        }
    }

    public function testGetCurrentPage(): void
    {
        $router = $this->getMockBuilder(RouterInterface::class)->getMock();

        foreach (
            [
                [30, 30],
                [26, 26],
                [13, 13],
                [0, AssertionError::class],
                [-1, AssertionError::class],
            ] as $case
        ) {
            [$currentPage, $expected] = $case;

            if ($expected === AssertionError::class) {
                $this->expectException(AssertionError::class);
            }

            $paginator = new Paginator(
                $router,
                'test_route',
                ['testRouteParam' => 'testRouteParamValue'],
                $currentPage,
                13,
                'customPage',
            );

            $this->assertEquals($expected, $paginator->getCurrentPage());
        }
    }

    # @TODO test also default values
    public function testGetUrl(): void
    {
        foreach (
            [
                ['test_route', ['testRouteParam' => 'testRouteParamValue'], 'customPage', 1],
                ['test_route', [], 'page', 5],
            ] as $case
        ) {
            [$route, $routeParams, $urlParamName, $page] = $case;

            $router = $this->getMockBuilder(RouterInterface::class)->getMock();
            $router
                ->expects($this->once())
                ->method('generateUrl')
                ->with($route, array_merge($routeParams, [$urlParamName => $page]))
                ->willReturn('success_url');

            $paginator = new Paginator(
                $router,
                $route,
                $routeParams,
                5,
                13,
                $urlParamName,
            );

            $this->assertEquals('success_url', $paginator->getUrl($page));
        }
    }

    public function testGetRecordsPerPage(): void
    {
        $router = $this->getMockBuilder(RouterInterface::class)->getMock();

        foreach (
            [
                [30, 30],
                [26, 26],
                [13, 13],
                [0, AssertionError::class],
                [-1, AssertionError::class],
            ] as $case
        ) {
            [$recordsPerPage, $expected] = $case;

            if ($expected === AssertionError::class) {
                $this->expectException(AssertionError::class);
            }

            $paginator = new Paginator(
                $router,
                'test_route',
                ['testRouteParam' => 'testRouteParamValue'],
                1,
                $recordsPerPage,
                'customPage',
            );

            $this->assertEquals($expected, $paginator->getRecordsPerPage());
        }
    }

    public function testGetGetOffset(): void
    {
        $router = $this->getMockBuilder(RouterInterface::class)->getMock();

        foreach (
            [
                [1, 10, 0],
                [2, 10, 10],
                [3, 10, 20],
                [3, 5, 10],
                [0, 0, AssertionError::class],
                [-1, -1, AssertionError::class],
            ] as $case
        ) {
            [$currentPage, $recordsPerPage, $expected] = $case;

            if ($expected === AssertionError::class) {
                $this->expectException(AssertionError::class);
            }

            $paginator = new Paginator(
                $router,
                'test_route',
                ['testRouteParam' => 'testRouteParamValue'],
                $currentPage,
                $recordsPerPage,
                'customPage',
            );

            $this->assertEquals($expected, $paginator->getOffset());
        }
    }
}
