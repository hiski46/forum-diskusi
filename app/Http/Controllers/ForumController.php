<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $data['forum'] = Forum::get();
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
        $img = ['jpg', 'pbg', 'jped', 'gif', 'jpeg', 'tiff', 'bmp', 'svg', 'heif'];
        $video = ['mp4', 'avi', 'mpg', 'webm', 'mkv', 'gifv', 'wmv', 'mov', 'flv', '3gp', 'avchd'];
        if (in_array($eks, $img)) {
            return 'gambar';
        } else if (in_array($eks, $video)) {
            return 'video';
        } else {
            return 'document';
        }
    }
}
