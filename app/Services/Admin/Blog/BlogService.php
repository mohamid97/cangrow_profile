<?php
namespace App\Services\Admin\Blog;

use App\Models\Api\Admin\Blog;
use App\Services\BaseModelService;
use App\Traits\HandlesImage;
use App\Traits\StoreMultiLang;
use Illuminate\Database\Eloquent\Builder;
class BlogService extends BaseModelService{
    
    use StoreMultiLang , HandlesImage;
    protected string $modelClass = Blog::class;
    protected array  $relations  = ['category', 'faqs', 'author', 'relatedBlogs'];




    public function all($request){
        $blog = parent::all($request);
        return $blog;
    }

    public function view($id){
        $blogDetails = parent::view($id);
        return $blogDetails;
    }

    public function store()
    {
  
        $this->uploadSingleImage(['blog_image' , 'breadcrumb'] , 'uploads/blog');
        $this->data['slug']  = $this->createSlug($this->data);
        $blog = parent::store($this->getBasicColumn(['breadcrumb', 'blog_image', 'category_id', 'author_box_id', 'is_active']));
        if (!empty($this->data['updated_at'])) {
            $blog->timestamps = false;
    
            $blog->update([
                'updated_at' => $this->data['updated_at'],
            ]);
    
            $blog->timestamps = true;
       }
        $this->processTranslations($blog, $this->data, ['title', 'slug' ,'des' , 'small_des' , 'meta_title' , 'meta_des', 'alt_image' , 'title_image']);  
       $this->syncFaqs($blog);
        $this->syncRelatedBlogs($blog);
        return $blog->load(['faqs', 'author', 'relatedBlogs']);
        
    }
    


    public function update($id ){
        $this->uploadSingleImage(['blog_image' , 'breadcrumb'] , 'uploads/blog');
        $blog = parent::update($id, $this->getBasicColumn(['breadcrumb', 'blog_image', 'category_id', 'author_box_id', 'is_active']));
        if (!empty($this->data['updated_at'])) {
            $blog->timestamps = false;
    
            $blog->update([
                'updated_at' => $this->data['updated_at'],
            ]);
    
            $blog->timestamps = true;
       }
        $this->processTranslations($blog, $this->data, ['title', 'slug' ,'des' , 'small_des' , 'meta_title' , 'meta_des', 'alt_image' , 'title_image']);
       $this->syncFaqs($blog);
        $this->syncRelatedBlogs($blog);
        return $blog->load(['faqs', 'author', 'relatedBlogs']);
        
    }

    private function syncRelatedBlogs(Blog $blog): void
    {
        if (array_key_exists('related_blog_ids', $this->data)) {
            $blog->relatedBlogs()->sync($this->data['related_blog_ids']);
        }
    }

    private function syncFaqs(Blog $blog): void
    {
       if (array_key_exists('faqs_ids', $this->data)) {
           $blog->faqs()->sync($this->data['faqs_ids']);
       }
    }

    public function delete($id){
        $blog = parent::delete($id);
        return $blog;
    }


    public function applySearch(Builder $query, string $search ){
        return $query->where(function ($q) use ($search) {
            $q->whereTranslationLike('title', "%$search%")
              ->orWhereTranslationLike('slug', "%$search%");
        });
    }

    public function orderBy(Builder $query, string $orderBy, string $direction = 'asc')
    {
        return $query->orderBy($orderBy, $direction);
    }


    


}