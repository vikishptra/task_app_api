<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetNotesRequest $request):JsonResponse
    {
        $data = $request->validated();
        $currentPage = $data['page'];
        $pageSize = $data['page_size'] ?? 15;


        $notes = Note::orderBy('id', 'desc')->simplePaginate(
            $pageSize,
            ['*'],
            'page',
            $currentPage
        );

        return $this->messagesSuccess($notes->getCollection());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request):JsonResponse
    {
        $note = Note::create($request->validate());

        return $this->messagesSuccess($note, 'Note anda berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note):JsonResponse
    {
        return $this->messagesSuccess($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, Note $note): JsonResponse
    {
        $note->update($request->validated());

        return $this->messagesSuccess($note->refresh(), 'Note anda berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note): JsonResponse
    {
        $note->delete();

        return $this->messagesSuccess($note->id, 'Note anda berhasil di delete!');
    }
}
