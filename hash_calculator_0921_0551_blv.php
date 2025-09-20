<?php
// 代码生成时间: 2025-09-21 05:51:25
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/hash")
 */
class HashController extends AbstractController
{
    /**
     * Hash Value Calculator Tool
     *
     * @param Request $request
     * @return Response
     */
    public function calculateHash(Request $request): Response
    {
        // Retrieve the input data from the request
        $inputData = $request->request->get('data');

        // Check if the input data is provided
        if (!$inputData) {
            // Return an error response if no data is provided
            return new Response(
                json_encode(
                    ['error' => 'No input data provided.']
                ),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        // Calculate the hash using SHA-256 algorithm
        $hash = hash('sha256', $inputData);

        // Return the calculated hash as a JSON response
        return new Response(
            json_encode(
                ['hash' => $hash]
            ),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}