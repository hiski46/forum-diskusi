<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $forum = Forum::with(['user']);
        $data['selectedKnowlage'] = null;
        if ($request->knowlage) {
            $forum = $forum->where('knowlage', '=', $request->knowlage);
            $data['selectedKnowlage'] = $request->knowlage;
        }
        $data['forum'] = $forum->get();
        return view('menu.forum', $data);
    }

    public function halamanTambahForum()
    {
        return view('menu.add_forum');
    }

    public function tambahForum(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
        ]);
        $data = $request->except(['_token', 'file']);
        $data['type'] = 'normal';
        $data['created_by'] = Auth::user()->id;
        $data['file'] = null;
        if ($request->has('file')) {
            if ($request->file('file')) {
                $file = $request->file('file');
                $data['file'] = uniqid() . '.' . $file->extension();

                $data['type'] = $this->cekEkstensi($file->extension());
                $file->storeAs('file_forum', $data['file'], ['disk' => 'public']);
            } else {
                return back()->withErrors([
                    'file' => 'File gagal di upload.',
                ])->onlyInput();
            }
        }
        $save = Forum::create($data);
        if ($save) {
            return redirect('/forum')->with('success', 'Berhasil menambahkan diskusi');
        }
        return back()->onlyInput();
    }

    public function cekEkstensi($eks)
    {
        $img = ['jpg', 'pbg', 'jped', 'gif', 'jpeg', 'tiff', 'bmp', 'svg', 'heif', 'png'];
        $video = ['mp4', 'avi', 'mpg', 'webm', 'mkv', 'gifv', 'wmv', 'mov', 'flv', '3gp', 'avchd'];
        if (in_array($eks, $img)) {
            return 'gambar';
        } else if (in_array($eks, $video)) {
            return 'video';
        } else {
            return 'document';
        }
    }

    public function detailForum($id)
    {
        $data['forum'] = Forum::with(['user', 'komentar'])->find($id);

        return view('menu.detail_forum', $data);
    }

    public function sendComment(Request $request, $id)
    {
        $data = $request->except(['_token']);

        $data['created_by'] = Auth::user()->id;
        $data['forum_id'] = $id;
        $save = Coment::create($data);
        if ($save) {
            return redirect("/detail-forum/$id")->with('success', 'Berhasil menambahkan komentar');
        }
    }

    public function getForum(Request $request)
    {
        $id_user = Auth::user()->id;
        $forum = Forum::with(['user', 'komentar'])->where('created_by', '=', $id_user);
        // $forum = Forum::with(['user', 'komentar']);
        if ($request->type == null) {
            $forum = $forum->get();
            $data['type'] = 'forum-all';
            $data['judul'] = 'Semua Forum';
        } else {
            $data['type'] = 'forum-' . $request->type;
            $data['judul'] = $this->getJudul($request->type);

            $forum = $forum->where('type', '=', $request->type)->get();
        }

        $data['forum'] = $forum;
        return view('menu.get_forum', $data);
    }

    public function getJudul($type)
    {
        $list = [
            'gambar' => 'Forum Dengan Gambar',
            'video' => 'Forum Dengan Video',
            'document' => 'Forum Dengan Dokumen',
            'normal' => 'Forum Tanpa File'
        ];

        return $list[$type];
    }


    public function halamanEditForum(Request $request, $id)
    {
        $data['type'] = $request->type;
        $data['forum'] = Forum::with(['user', 'komentar'])->find($id);
        if ($data['forum']->created_by != Auth::user()->id) {
            return redirect('/');
        }

        return view('menu.edit_forum', $data);
    }


    public function editForum(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
        ]);
        $type = substr($request->type, 6);
        $type = $type == 'all' ? null : $type;
        $data = $request->except(['_token', 'type', 'old_file']);
        $data['file'] = $request->old_file;
        if ($request->has('file')) {
            if ($request->file('file')) {
                $file = $request->file('file');
                $data['file'] = uniqid() . '.' . $file->extension();

                $data['type'] = $this->cekEkstensi($file->extension());
                $file->storeAs('file_forum', $data['file'], ['disk' => 'public']);
            } else {
                return back()->withErrors([
                    'file' => 'File gagal di upload.',
                ])->onlyInput();
            }
        }

        $update = Forum::where('id', '=', $id)->update($data);
        if ($update) {

            return redirect("/get-forum?type=$type")->with('success', 'Berhasil mengubah forum');
        }
    }

    public function deleteForum(Request $request, $id)
    {
        $forum = Forum::find($id);
        if ($forum->created_by != Auth::user()->id) {
            return redirect('/');
        }
        $type = substr($request->type, 6);
        $type = $type == 'all' ? null : $type;
        if ($forum->delete()) {
            return redirect("/get-forum?type=$type")->with('success', 'Berhasil menghapus forum');
        }
    }
}
