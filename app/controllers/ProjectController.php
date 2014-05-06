<?php

use \Informulate\Transformers\ProjectsTransformer;

class ProjectController extends ApiController
{

	/**
	 * @var Informulate\Transformers\ProjectsTransformer
	 */
	protected $projectTransformer;

	function __construct(ProjectsTransformer $projectTransformer)
	{
		$this->projectTransformer = $projectTransformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /project
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', 10);
		$limit = $limit > 100 ? 10 : $limit; // limits the per page to 100.

		$projects = Project::paginate($limit);

		return $this->respondWithPagination($projects, [
			'data' => $this->projectTransformer->transformCollection($projects->all()),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /project/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = [
			'form' => [
				'string' => 'name'
			],
			'action' => URL::route('api.v1.projects.store'),
			'method' => 'POST'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /project
	 *
	 * @return Response
	 */
	public function store()
	{
		$creator = new Creator($this);

		return $creator->create(Input::all());
	}

	/**
	 * @param $errors
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function projectCreationFails($errors)
	{
		return $this->respondWithError($errors);
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function projectCreationSucceeds()
	{
		return $this->respond(['data' => ['success' => true]]);
	}

	/**
	 * Display the specified resource.
	 * GET /project/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::findByIdOrSlug($id);

		if ($project) {
			return $this->respond($this->projectTransformer->transform($project));
		}

		return $this->respondNotFound();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /project/{id}/edit
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::findByIdOrSlug($id);

		if (!$project) {
			return $this->respondNotFound();
		}

		$data = [
			'form' => [
				'name' => $project->name
			],
			'action' => URL::route('api.v1.projects.update', ['project' => $id]),
			'method' => 'PUT'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /project/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /project/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}