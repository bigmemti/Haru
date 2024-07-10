<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;

class LeafCategory implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $category = Category::find($value);
        if (!($category && $category->children()->count() === 0)){
            $fail(__('The selected category must be a leaf category.'));
        }
    }
}
