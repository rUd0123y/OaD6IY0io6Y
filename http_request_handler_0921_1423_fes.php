<?php
// 代码生成时间: 2025-09-21 14:23:52
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class HttpRequestHandler
{
    private $router;

    /**
     * 构造函数
     * @param RouterInterface $router 路由器实例
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * 处理HTTP请求
     * @param Request $request HTTP请求实例
     * @return Response HTTP响应实例
     */
    public function handleRequest(Request $request): Response
    {
        try {
            // 匹配路由
            $attributes = $this->router->match($request->getPathInfo());

            // 获取控制器和方法
            $controller = $attributes['_controller'];
            $method = $attributes['_method'];

            // 调用控制器方法
            if (is_callable($controller)) {
                return call_user_func($controller, $request);
            } else {
                throw new \Exception('无效的控制器或方法');
            }
        } catch (ResourceNotFoundException $e) {
            // 处理404错误
            return new JsonResponse(['error' => '资源未找到'], 404);
        } catch (MethodNotAllowedException $e) {
            // 处理405错误
            return new JsonResponse(['error' => '方法不允许'], 405);
        } catch (\Exception $e) {
            // 处理其他错误
            return new JsonResponse(['error' => '服务器错误'], 500);
        }
    }
}
