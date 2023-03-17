<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\TemporaryFile;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setting-index|setting-create|setting-edit|setting-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:setting-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $settings = Setting::paginate();
        return view('backend.setting.index', compact('settings'));
    }
    public function create()
    {
        return view('backend.setting.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'logo' => 'required'
        ]);
        $temporaryFile = TemporaryFile::where('filename', $request->logo)->first();
        if ($temporaryFile) {
            $data['logo'] = $temporaryFile->filename;
            $temporaryFile->delete();
        };
        Setting::create($data);
        session()->flash('success');
        return redirect(route('setting.index'));
    }
    public function edit(Setting $setting)
    {
        return view('backend.setting.create', compact('setting'));
    }
    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([]);
        $setting->update($data);
        session()->flash('success');
        return redirect(route('setting.index'));
    }
    public function destroy(Setting $setting)
    {
        $setting->delete();
        session()->flash('success');
        return back();
    }
}
