<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Notices;
use App\Models\NoticeCategories;
use App\Models\NoticeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\NoticesStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;


class NoticesController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:mostrar-noticias', ['only' => ['index']]);
    //     $this->middleware('permission:crear-noticia', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:ver-noticia', ['only' => ['show']]);
    //     $this->middleware('permission:editar-noticia', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:eliminar-noticia', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notices::all();
        return view('pages.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Notices $notices)
    {
        // return $notices;
        $categories = NoticeCategories::all();
        return view('pages.notices.create', compact('notices', 'categories'));
    }

    public function list()
    {
        $model = Notices::query()->orderBy('created_at', 'desc');

        $data = DataTables::of($model)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('media_path', function ($row) {
                return $row->media_path;
            })
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('link', function ($row) {
                return $row->link;
            })
            ->addColumn('content', function ($row) {
                return Str::limit($row->content, 50);
            })
            ->addColumn('action', function($row){
                return '<div class="d-flex">
                    <a href='. route('notices.detail', $row) .' class="btn btn-icon btn-info btn-sm me-1">
                        <i class="ti ti-eye"></i>
                    </a>
                    <a href='. route('notices.create', $row) .' class="btn btn-icon btn-warning btn-sm me-1">
                        <i class="ti ti-pencil"></i>
                    </a>
                    <button class="btn btn-icon btn-danger btn-sm modal-pers" data-path="'. route('notices.modalDelete', $row) .'">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['id', 'media_path', 'title', 'link', 'content', 'action'])
            ->toJson();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticesStoreRequest $request)
    {
        $input = $request->all();
        $mediaPathsArray = explode(',', $input['media_path']);

        DB::beginTransaction();
        try {
            $notice = Notices::create($request->only('title', 'link', 'content', 'main',  'category_id'));

            foreach ($mediaPathsArray as $path) {
                $noticeFile = new NoticeFile();
                $noticeFile->notices_id = $notice->id;
                $noticeFile->file_path = $path;
                $noticeFile->save();
            }

            DB::commit();

            session()->flash('success', 'Noticia creada con éxito.');

            return redirect()->route('notices.index');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Hubo un error al crear la noticia. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function uploads(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file('media_path');
            $img = date('YmdHis') . "_" . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $img);
            $fullPath = 'storage/uploads/' . $img;

            DB::commit();

            session()->flash('success', 'Archivo creado con éxito.');

            return $fullPath;

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Hubo un error al guardar el archivo. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return $e->getMessage();
        }
    }

    public function preview()
    {
        $notices = Notices::all();
        $mainArticles = Notices::where('main', '1')->orderBy('id', 'desc')->take(40)->get();
        $subArticles = Notices::where('main', '0')->orderBy('id', 'desc')->take(15)->get();

        return view('pages.notices.preview', compact('mainArticles', 'subArticles', 'notices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function show(Notices $notices)
    {
        //
    }
    public function detail(Notices $notices)
    {
        $previousNotice = Notices::where('id', '<', $notices->id)->orderBy('id', 'desc')->first();
        $nextNotice = Notices::where('id', '>', $notices->id)->orderBy('id', 'asc')->first();

        return view('pages.notices.detail', compact('notices', 'previousNotice', 'nextNotice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.notices.create', compact('notices'));
    }

    public function modal_delete_masive()
    {
        return view('pages.notices.modal.deleteMasiveNotices');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function update(NoticesStoreRequest $request, Notices $notices)
    {
        // return $request;
        $input = $request->all();
        $mediaPathsArray = explode(',', $input['media_path']);

        DB::beginTransaction();
        try {
            $notices->update($request->only('title', 'link', 'content', 'main',  'category_id'));

            foreach ($mediaPathsArray as $path) {
                // $notices->files()->delete();
                $noticeFile = new NoticeFile();
                $noticeFile->notices_id = $notices->id;
                $noticeFile->file_path = $path;
                $noticeFile->save();
            }

            DB::commit();

            session()->flash('success', 'Noticia actualizada con éxito.');

            return redirect()->route('notices.index');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Hubo un error al actualizar la noticia. Por favor, inténtalo de nuevo. Error: ' . $e->getMessage());

            return redirect()->back();
        }
    }


    public function modal_delete(Notices $notices)
    {
        return view('pages.notices.modal.deleteNotices', compact('notices'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notices  $notices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notices $notices)
    {
        try {
            $notices->delete();
            return response()->json(['success' => 'Noticia eliminada correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lo sentimos, hubo un error al completar la acción'], 200);
        }
    }

    public function deleteAttachment(NoticeFile $noticesFile)
    {
        try {
            $noticesFile->delete();
            return response()->json(['success' => 'Archivo eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Lo sentimos, hubo un error al completar la acción'], 200);
        }
    }

    public function deleteMasive(Request $request)
    {
        $ids = $request->input('ids');

        try {
            Notices::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Las noticias seleccionadas se han eliminado correctamente.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Lo sentimos sucedió algo al realizar la acción.']);
        }
    }
}
