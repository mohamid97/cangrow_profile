<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\Admin\Blog;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ResponseTrait;

    public function getFaqs(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:blogs,id',
        ]);

        $blog = Blog::with('faqs')->findOrFail($validated['id']);

        return $this->success($blog->faqs, 'FAQs retrieved successfully');
    }
}
