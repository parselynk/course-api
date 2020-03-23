<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\SessionsInterface;

class SessionsController extends Controller
{
    
    protected $session;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SessionsInterface $repository)
    {
        $this->session = $repository;
    }

    public function getProgressHistory($id)
    {
        try {
            $response = $this->session->getProgressHistory($id);

            if (!empty($response)) {
                return response()->json($response, 200);
            }

            return $this->notFoundResponse();
        } catch (\Exception $e) {
            // log the message and
            return $this->notFoundResponse($e->getMessage(), 400);
        }
    }

    public function getLastSessionCategories($id)
    {
        
        try {
            $response = $this->session->getLastSessionCategories($id);
            
            if (!empty($response)) {
                return response()->json($response, 200);
            }

            return $this->notFoundResponse();
        } catch (\Exception $e) {
            // log the message and
            return $this->notFoundResponse($e->getMessage(), 400);
        }
    }

    protected function notFoundResponse($message = 'session not found.', $statusCode = 404)
    {
        return response()->json(['message' => $message], $statusCode);
    }
}
