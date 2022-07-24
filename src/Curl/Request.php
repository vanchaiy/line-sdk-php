<?php

namespace LineSDK\Curl;

class Request
{
    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    public function get(string $url = '', $body = '')
    {
        return $this->request('GET', $url, $body);
    }

    public function post(string $url = '', $body = '')
    {
        return $this->request('POST', $url, $body);
    }

    public function put(string $url = '', $body = '')
    {
        return $this->request('PUT', $url, $body);
    }

    public function delete(string $url = '', $body = '')
    {
        return $this->request('DELETE', $url, $body);
    }

    public function request(string $method, string $url, $body)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_HEADER => 1,
        ));

        $response = curl_exec($curl);
        $curl_info = curl_getinfo($curl);
        $header = $this->get_headers_from_curl_response($response);
        $body = substr($response, $curl_info["header_size"]);
        $error = curl_error($curl);

        curl_close($curl);

        $content_type = $header["Content-Type"] ?? null;

        if ($content_type == "application/json" || (strpos($body, "{") !== false || strpos($body, "}") !== false)) {
            $body = json_decode($body, true);
        }

        $ouput["status"] = $curl_info["http_code"];
        $ouput["header"] = $header;
        
        if ($body) {
            $ouput["body"] = $body;
        }

        if ($error) {
            $ouput["error"] = $error;
        }

        return (object) $ouput;
    }

    public function get_headers_from_curl_response($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list($key, $value) = explode(': ', $line);
                $headers[$key] = $value;
            }
        }
        return $headers;
    }

}
