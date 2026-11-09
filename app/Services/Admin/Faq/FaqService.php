<?php 
namespace App\Services\Admin\Faq;

use App\Models\Api\Admin\Faq;
use App\Services\BaseModelService;
use App\Traits\StoreMultiLang;

class FaqService extends BaseModelService{
    use StoreMultiLang;

    protected string $modelClass = Faq::class;
    protected array $relations = ['blogs'];
    
    public function store()
    {
        $this->uploadSingleImage(['icon'] , 'uploads/faq');
        $faq = parent::store($this->getBasicColumn(['icon' , 'topic']));
        $this->processTranslations($faq, $this->data, ['question' , 'answer']);
        $this->syncBlogs($faq);

        return $faq->load('blogs');
    }

    public function update($id)
    {
        $this->uploadSingleImage(['icon'], 'uploads/faq');
        $faq = parent::update($id, $this->getBasicColumn(['icon', 'topic']));
        $this->processTranslations($faq, $this->data, ['question', 'answer']);
        $this->syncBlogs($faq);

        return $faq->load('blogs');
    }

    private function syncBlogs(Faq $faq): void
    {
        if (array_key_exists('blog_ids', $this->data)) {
            $faq->blogs()->sync($this->data['blog_ids']);
        }
    }
}