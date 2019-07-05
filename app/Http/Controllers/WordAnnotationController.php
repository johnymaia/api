<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\WordAnnotationService;
use App\Services\GoogleService;

class WordAnnotationController extends Controller
{
    private $service;
    private $googleService;
    public function __construct(WordAnnotationService $service, GoogleService $googleService)
    {
        $this->service = $service;
        $this->googleService = $googleService;
    }

    public function getAll()
    {
        try {
            return response()->json($this->service->getAll(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            return response()->json($this->service->get($id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function store(Request $request)
    {
        try {
            return response()->json(
                $this->service->store($request->all()),
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            return response()->json(
                $this->service->update($id, $request->all()),
                Response::HTTP_OK
            );
        } catch (CustomValidationException $e) {
            return $this->error($e->getMessage(), $e->getDetails());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            return response()->json(
                $this->service->destroy($id),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function googlevision(Request $request)
    {
        try {
            return response()->json(
                $this->googleService->googlevision($request->all()),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
