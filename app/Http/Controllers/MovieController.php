<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieCollection;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
 * @OA\Get(
 *     path="/api/movies",
 *     description="Displays all the movies",
 *     summary="Show all Movies",
 *     tags={"Movies"},
     *      @OA\Response(
        *          response=200,
        *          description="Successful operation, Returns a list of Movies in JSON format"
        *       ),
        *      @OA\Response(
        *          response=401,
        *          description="Unauthenticated",
        *      ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
 * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // to view all movies localhost/api/movies
    {
        // $movies = Movie::all();
        // return new MovieCollection($movies);
        // return new MovieCollection(Movie::all());
        return new MovieCollection(Movie::with('production_company')->with('directors')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/movies",
     *      operationId="store",
     *      tags={"Movies"},
     *      summary="Create a new Movie",
     *      description="Stores the movie in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "year", "category", "description", "rating", "image", "production_company_id", "directors"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="year", type="integer", format="integer", example="Year"),
     *            @OA\Property(property="category", type="string", format="string", example="Category"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this movie"),
     *            @OA\Property(property="rating", type="integer", format="integer", example="(Rate up to 10)"),
     *            @OA\Property(property="image", type="string", format="string", example="Image"),
     *            @OA\Property(property="production_company_id", type="integer", format="integer", example="1"),
     *            @OA\Property(property="directors", type="array", 
     *             @OA\Items(
     *                      @OA\Property(
     *                         type="integer",
     *                         example="1"
     *                      )
     *                  )  
     *              )
     *            
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     * @param  \Illuminate\Http\StoreMovieRequest  $request
     * @return \Illuminate\Http\MovieResource
     */
    public function store(StoreMovieRequest $request) // create new movie / attributes for each movie using insomnia or swagger
    {
        $movie = Movie::create([
            'title' => $request->title,
            'year' => $request->year,
            'category' => $request->category,
            'description' => $request->description,
            'rating' => $request->rating,
            'image' => $request->image,
            'production_company_id' => $request->production_company_id
        ]);

        $movie->directors()->attach($request->directors);

        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
    *     path="/api/movies/{id}",
    *     description="Gets a movie by ID",
    *     summary="View Movie by ID",
    *     tags={"Movies"},
    *          @OA\Parameter(
        *          name="id",
        *          description="Movie id",
        *          required=true,
        *          in="path",
        *          @OA\Schema(
        *              type="integer")
     *          ),
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation"
        *       ),
        *      @OA\Response(
        *          response=401,
        *          description="Unauthenticated",
        *      ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
 * )
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\MovieResource
     */
    public function show(Movie $movie) // returning back movies
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *      path="/api/movies/{id}",
     *      operationId="edit",
     *      tags={"Movies"},
     *      summary="Edit a Movie by ID",
     *      description="Edit the movie by ID",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
        *          name="id",
        *          description="Movie id",
        *          required=true,
        *          in="path",
        *          @OA\Schema(
        *              type="integer")
     *          ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "year", "category", "description", "rating", "image"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="year", type="integer", format="integer", example="Year"),
     *            @OA\Property(property="category", type="string", format="string", example="Category"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this movie"),
     *            @OA\Property(property="rating", type="integer", format="integer", example="(Rate up to 10)"),
     *            @OA\Property(property="image", type="string", format="string", example="Image"),
     *            @OA\Property(property="production_company_id", type="integer", format="integer", example="1"),
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie) // update any information for each movie using insomnia or swagger
    {
        $movie->update($request->only([
            'title', 'year', 'category', 'description', 'rating', 'image', 'production_company_id'
        ]));

        return new MovieResource($movie);
    }

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/movies/{id}",
     *    operationId="destroy",
     *    tags={"Movies"},
     *    summary="Delete a Movie by ID",
     *    description="Delete Movie",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of a Movie", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie) // to delete movie by id using insomnia or swagger
    {
        $movie->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
