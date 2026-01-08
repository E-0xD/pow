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

            return redirect()->route('admin.template.index')
                ->with([
                    'type' => 'success',
                    'message' => 'Template created successfully!'
                ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.template.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while creating template'
                ]);
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

            return redirect()->route('admin.template.index')->with([
                'type' => 'success',
                'message' => 'Template updated successfully!'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.template.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while updating template'
                ]);
        }
    }

    public function destroy(Template $template)
    {
        try {
            if ($template->thumbnail_path) {
                Storage::disk('public')->delete($template->thumbnail_path);
            }

            $template->delete();

            return redirect()->route('admin.template.index')
                ->with([
                    'type' => 'success',
                    'message' => 'Template Deleted successfully!'
                ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.template.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while deleting template'
                ]);
        }
    }
}
