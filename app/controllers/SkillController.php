<?php

use Informulate\Skill\Creator;
use \Informulate\Transformers\SkillsTransformer;

class SkillController extends ApiController {

	/**
	 * @var Informulate\Transformers\SkillSetsTransformer
	 */
	protected $skillTransformer;

	/**
	 * @param SkillsTransformer $skillTransformer
	 */
	function __construct(SkillsTransformer $skillTransformer)
	{
		$this->skillTransformer = $skillTransformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /skills
	 *
	 * @return Response
	 */
	public function index()
	{
		$skills = Skill::paginate($this->getLimit());

		return $this->respondWithPagination($skills, [
			'data' => $this->skillTransformer->transformCollection($skills->all()),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /occupations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = [
			'form' => [
				'string' => 'name'
			],
			'action' => URL::route('api.v1.occupations.store'),
			'method' => 'POST'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /occupation
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
	public function skillCreationFails($errors)
	{
		return $this->respondWithError($errors);
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function skillCreationSucceeds()
	{
		return $this->respond(['data' => ['success' => true]]);
	}

	/**
	 * Display the specified resource.
	 * GET /occupation/{id}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$skill = Skill::where('slug', $slug)->firstOrFail();

		if ($skill) {
			return $this->respond($this->skillTransformer->transform($skill));
		}

		return $this->respondNotFound();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /occupations/{id}/edit
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function edit($slug)
	{
		$skill = SkillSet::where('slug', $slug)->firstOrFail();

		if (! $skill) {
			return $this->respondNotFound();
		}

		$data = [
			'form' => [
				'name' => $skill->name
			],
			'action' => URL::route('api.v1.skill.update', ['skill' => $slug]),
			'method' => 'PUT'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /occupation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /occupations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}