<?php
// 代码生成时间: 2025-09-19 16:55:32
require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class NetworkConnectionChecker
{
    private HttpClient $client;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    /**
     * 检查网络连接
     *
     * @param string $url 要检查的URL
     * @return bool|\Throwable
     */
    public function checkConnection(string $url)
    {
        try {
            $response = $this->client->request('HEAD', $url);
            if ($response->getStatusCode() === 200) {
                // 响应状态码为200，连接成功
                return true;
            } else {
                // 处理非200响应状态码
                return new \Exception("Connection failed with status code: {$response->getStatusCode()}");
            }
        } catch (ClientExceptionInterface $e) {
            // 客户端错误
            return new \Exception("Client error: {$e->getMessage()}");
        } catch (TransportExceptionInterface $e) {
            // 传输层错误
            return new \Exception("Transport error: {$e->getMessage()}");
        } catch (\Throwable $e) {
            // 其他错误
            return $e;
        }
    }
}

// 示例用法
$checker = new NetworkConnectionChecker();
$result = $checker->checkConnection('https://www.example.com');
if ($result === true) {
    echo 'Connection successful';
} else {
    if ($result instanceof \Throwable) {
        echo $result->getMessage();
    } else {
        echo 'Unknown error';
    }
}
