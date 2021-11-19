<?php

class Request
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    private string $method;
    private string $path;
    private array $request;
    private array $query;

    public function __construct(string $method, string $path, array $request, array $query)
    {
        $this->method = $method;
        $this->path = $path;
        $this->request = $this->sanitizeInput($request);       
        $this->query = $this->sanitizeInput($query);

        $data = json_decode(file_get_contents("php://input"), true); 
        if ($data) {
            $this->request = array_merge($data, $this->request);
        }
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function get(string $key, $default = null)
    {
        if (isset($this->request[$key])) {
            return $this->request[$key];
        }

        if (isset($this->query[$key])) {
            return $this->query[$key];
        }

        return $default;
    }

    private function sanitizeInput(array $arr): array
    {
        foreach ($arr as $key => $value) {
            $arr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            $arr[$key] = htmlspecialchars($arr[$key]);
        }

        return $arr;
    }
}
