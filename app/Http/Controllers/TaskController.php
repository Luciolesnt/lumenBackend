<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'createOneTask',
        ]]);
    }

    public function showAllTasks()
    {
        $taskList = Task::all()->load('category');
        return response()->json($taskList);
    }

    public function showOneTask(int $id)
    {
        Log::debug('Task id', [$id]);

        $oneTask = Task::findOrFail($id)->load('category');
        return response()->json($oneTask);
    }

    public function createOneTask(Request $request)
    {
               // Validation des données
        // @see https://lumen.laravel.com/docs/8.x/validation

        // En cas d'échec de la validation
        // Un JSON est retourné avec un statut 422 (Unprocess entity) automatiquement

        $this->validate($request, [
            'title' => 'required|min:3|max:128',
            // @see https://laravel.com/docs/7.x/validation#rule-exists
            // => on s'assure que categoryId existe dans la table *categories*
            // => sur la colonne *id* (que la catégorie fournie existe)
            'categoryId' => 'required|integer|exists:categories,id',
            // Optionnel (pas de required)
            'completion' => 'integer|between:0,100',
            'status' => 'integer|in:1,2'
        ]);

        // récupérer toutes les données envoyées en POST
        $title = $request->input('title');
        $categoryId = $request->input('categoryId');
        $completion = $request->input('completion');
        $status = $request->input('status');

        // créer un nouvel objet pour la classe Task
        $task = new Task();
        // modifier les propriétés de cet objet
        $task->title = $title;
        $task->category_id = $categoryId;
        $task->completion = $completion;
        $task->status = $status;
        // sauvegarder l'objet Task
        $success = $task->save();

        // en cas d'échec
        if ( ! $success ) {
            // alors retourner un code de réponse HTTP 500 "Internal Server Error"
            return response()->json(
                ['message' => 'Erreur à l\'enregistrement.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        // Avant de transmettre les données de la tache nouvellement créée
            // on charge les infos de la catégorie associée à une tache.
            $task->load("category");

        // sinon retourner un code de réponse HTTP 201 "Created"
        return response()->json(
            // La tâche créée
            $task,
            // Le statut 201
            Response::HTTP_CREATED,
            // Le header Location vers la ressource créée
            ['Location' => route('task-showOne', ['id' => $task->id])]
        );
    }
}
