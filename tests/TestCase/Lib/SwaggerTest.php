<?php


namespace SwaggerBake\Test\TestCase\Lib;


use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;
use Cake\TestSuite\TestCase;
use SwaggerBake\Lib\CakeModel;
use SwaggerBake\Lib\CakeRoute;
use SwaggerBake\Lib\Swagger;

class SwaggerTest extends TestCase
{
    public $fixtures = [
        'plugin.SwaggerBake.DepartmentEmployees',
        'plugin.SwaggerBake.Departments',
        'plugin.SwaggerBake.Employees',
        'plugin.SwaggerBake.EmployeeSalaries',
        'plugin.SwaggerBake.EmployeeTitles',
    ];

    private $router;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $router = new Router();
        $router::scope('/api', function (RouteBuilder $builder) {
            $builder->setExtensions(['json']);
            $builder->resources('Employees', function (RouteBuilder $routes) {
                $routes->resources('EmployeeSalaries');
                //$routes->resources('EmployeeTitles');
            });
            $builder->resources('Departments', function (RouteBuilder $routes) {
                $routes->resources('DepartmentEmployees');
            });
        });
        $this->router = $router;
    }

    public function testGetArrayWithExistingPathsAndSchema()
    {
        $prefix = '/api';
        $cakeRoute = new CakeRoute($this->router, $prefix);

        $swagger = new Swagger(
            'tests/assets/swagger-with-existing.yml',
            new CakeModel($cakeRoute, $prefix)
        );

        $arr = json_decode($swagger->toString(), true);

        $this->assertTrue(isset($arr['paths']['/pets']));
        $this->assertTrue(isset($arr['components']['schemas']['Pets']));
    }

    public function testGetArrayFromBareBones()
    {
        $prefix = '/api';
        $cakeRoute = new CakeRoute($this->router, $prefix);

        $swagger = new Swagger(
            'tests/assets/swagger-bare-bones.yml',
            new CakeModel($cakeRoute, $prefix, '\SwaggerBake\Test\Model\Entity\\')
        );


        $arr = json_decode($swagger->toString(), true);

        $this->assertTrue(isset($arr['paths']['/departments']));
        $this->assertTrue(isset($arr['components']['schemas']['Department']));
    }
}