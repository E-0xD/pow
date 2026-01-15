<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::latest()->paginate(10);
        return view('admin.template.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.template.form');
    }

    public function store(TemplateRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail_path'] = $request->file('thumbnail')->store('templates', 'public');
            }

            $data['tags'] = tagsStringToArray($data['tags']);

            Template::create($data);

            alert(type: 'success', message: 'Template created successfully');
            return redirect()->route('admin.template.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to create template.');
            return redirect()->route('admin.template.index');
        }
    }

    public function show(Template $template)
    {
        return view('admin.template.show', compact('template'));
    }

    public function edit(Template $template)
    {
        return view('admin.template.form', compact('template'));
    }

    public function update(TemplateRequest $request, Template $template)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                if ($template->thumbnail_path) {
                    Storage::disk('public')->delete($template->thumbnail_path);
                }
                $data['thumbnail_path'] = $request->file('thumbnail')->store('templates', 'public');
            }

            $data['tags'] = tagsStringToArray($data['tags']);

            $template->update($data);

            alert(type: 'success', message: 'Template updated successfully!');
            return redirect()->route('admin.template.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update template.');
            return redirect()->route('admin.template.index');
        }
    }

    public function destroy(Template $template)
    {
        try {
            if ($template->thumbnail_path) {
                Storage::disk('public')->delete($template->thumbnail_path);
            }

            $template->delete();

            alert(type: 'success', message: 'Template deleted successfully.');
            return redirect()->route('admin.template.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete template.');
            return redirect()->route('admin.template.index');
        }
    }
}
