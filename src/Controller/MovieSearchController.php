<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\ImdbService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MovieSearchController
{
    private $imdbService;

    public function __construct(ImdbService $imdbService)
    {
        $this->imdbService = $imdbService;
    }

    /**
     * @Route("/api/movie_search/{title}", name="movie_search", methods={"GET"})
     */
    public function movieSearch(string $title): JsonResponse
    {
        $posterUrl = $this->imdbService->getMoviePosterUrl($title);

        return new JsonResponse(['posterUrl' => $posterUrl]);
    }


    public function __invoke(Movie $data)
    {
        $data->setPosterUrl($this->movieSearch($data->getTitle()));
        return $data;
    }
}
