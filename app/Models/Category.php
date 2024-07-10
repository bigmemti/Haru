<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
    ];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(){
        return collect(DB::select('WITH RECURSIVE category_parents AS (
            SELECT id, parent_id
            FROM categories
            WHERE id = ?
            UNION ALL
            SELECT c.id, c.parent_id
            FROM categories c
            JOIN category_parents cp ON c.parent_id = cp.id
            ),
            category_ids AS (
                SELECT id FROM category_parents
            )
            SELECT p.*
            FROM products p
            JOIN category_ids ci ON p.category_id = ci.id;
        ', [$this->id]));
    }


    public function allParents()
    {
        $parents = collect([]);
        $category = $this;
        while ($category->parent) {
            $parents->prepend($category->parent);
            $category = $category->parent;
        }
        return $parents;
    }

    public static function leafCategoriesWithHierarchy($depth = 0)
    {
        $leafCategories = static::doesntHave('children')->get();
        $hierarchy = [];
        foreach ($leafCategories as $leaf) {
            $parents = $leaf->allParents();
            $currentLevel = &$hierarchy;
            $currentDepth = $depth;
            foreach ($parents as $parent) {
                if (!isset($currentLevel[$parent->id])) {
                    $currentLevel[$parent->id] = [
                        'category' => $parent,
                        'children' => [],
                        'depth' => $currentDepth,
                    ];
                }
                $currentLevel = &$currentLevel[$parent->id]['children'];
                $currentDepth++;
            }
            $currentLevel[$leaf->id] = [
                'category' => $leaf,
                'children' => [],
                'depth' => $currentDepth,
            ];
        }
        return collect($hierarchy);
    }
}
