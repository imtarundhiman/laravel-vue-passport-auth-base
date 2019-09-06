<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;

class ApiController extends Controller{
    
    /**
     * @var int
     */
    protected $pageLimit = 10;

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Returns the cache key
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function getCacheKey(Request $request)
    {
        $userId = '';
        if ($request->user()->id) {
            $userId = $request->user()->id;
        }

        return Str::slug($request->fullUrl() . $userId);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return self
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function respondSuccess($message = '')
    {
        return $this->setStatusCode(200)->respondWithData(['status' => 200], $message);
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function respondExists($message = '')
    {
        return $this->setStatusCode(409)->respondWithData(['status' => 409], $message);
    }

    /**
     * @return Response
     */
    public function respondNotFound()
    {
        return $this->setStatusCode(404)->respondWithError([trans('auth.not_found')]);
    }

    /**
     * @return Response
     */
    public function respondUnauthorized()
    {
        return $this->setStatusCode(401)->respondWithError([trans('auth.unauthorized')]);
    }

    /**
     * @return Response
     */

    public function respondDataNotSaved()
    {
        return $this->setStatusCode(500)->respondWithError([trans('setting.saveError')]);
    }

    /**
     * @return Response
     */
    public function respondForbidden()
    {
        return $this->setStatusCode(403)->respondWithError([trans('auth.forbidden')]);
    }

    /**
     * @return Response
     */
    public function respondResourceGone()
    {
        return $this->setStatusCode(410)->respondWithError([trans('auth.resource_gone')]);
    }

    /**
     * @return Response
     */
    public function respondInternal()
    {
        return $this->setStatusCode(500)->respondWithError([trans('auth.internal')]);
    }

    /**
     * @param array $data
     * @param string $message
     *
     * @return Response
     */
    public function respondWithData(array $data, $message = '')
    {
        if (!isset($data['data'])) {
            $tempData = $data;
            unset($data);
            $data['data'] = $tempData;
        }

        $data['message'] = $message;

        return $this->respond(
            $data,
            $this->getStatusCode()
        );
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public function respondWithError(array $data)
    {
        return $this->respond(
            $data,
            $this->getStatusCode()
        );
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    private function respond(array $data)
    {
        return Response::json(
            $data,
            $this->getStatusCode(),
            $this->getHeaders()
        );
    }
}

?>